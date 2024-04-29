<?php
class Jobseekers extends Controller
{

    public $jobseekerModel;
    public $jobModel;
    public $wishlistModel;
    public $applicationModel;
    public $algorithmModel;

    public function __construct()
    {
        $this->jobseekerModel = $this->model('Jobseeker');
        $this->jobModel = $this->model('Job');
        $this->wishlistModel = $this->model('Wishlist');
        $this->applicationModel = $this->model('Application');
        $this->algorithmModel = $this->model('Algorithm');
    }

    public function index()
    {
        $data = [
            'name' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'name_err' => '',
            'email_err' => '',
            'gender_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
            'login_email' => '',
            'login_password' => '',
            'login_email_err' => '',
            'login_password_err' => '',
        ];

        if (isset($_SESSION['user_id'])) {
            $this->dashboard();
        } else {
            $this->view('jobseeker/register', $data);
        }
    }

    private function verify_code($role_id, $role, $receiver, $receiver_name)
    {
        $this->jobseekerModel->generateVerificationCode($role_id, $role);
        $code = $this->jobseekerModel->getVerificationCode($role_id, $role);
        $subject = 'Verification Code';
        $body_string = 'Your verification code is: ' . $code->code;
        send_email($receiver, $receiver_name,  $subject, $body_string);
    }

    private function whichUser()
    {
        if (isset($_SESSION['user_id'])) {
            return 'seeker';
        } elseif (isset($_SESSION['business_id'])) {
            return 'recruiter';
        } elseif (isset($_SESSION['moderator_id'])) {
            return 'moderator';
        } elseif (isset($_SESSION['admin_id'])) {
            return 'admin';
        } else {
            return 'guest';
        }
    }

    private function onlySeeker()
    {
        if ($this->whichUser() !== 'seeker') {
            redirect('jobseekers/login');
            return;
        }
    }

    public function register()
    {

        if (isset($_SESSION['user_id'])) {
            $this->dashboard();
        } else {
            // Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Init data
                $data = [
                    'name' => trim(htmlspecialchars($_POST['name'])),
                    'email' => trim(htmlspecialchars($_POST['email'])),
                    'gender' => trim(htmlspecialchars($_POST['gender'])),
                    'password' => trim(htmlspecialchars($_POST['password'])),
                    'confirm_password' => trim(htmlspecialchars($_POST['confirm_password'])),
                    'name_err' => '',
                    'email_err' => '',
                    'gender_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'login_email' => '',
                    'login_password' => '',
                    'login_email_err' => '',
                    'login_password_err' => '',
                ];

                // Validate Email
                if (empty($data['email'])) {
                    $data['email_err'] = 'Pleae enter email';
                } else {
                    // Check email
                    if ($this->jobseekerModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                // Validate Name
                if (empty($data['name'])) {
                    $data['name_err'] = 'Pleae enter name';
                }

                if (empty($data['gender']) || $data['gender'] !== 'male' || $data['gender'] !== 'female') {
                    $data['gender_err'] = 'Pleae select gender';
                }

                // Validate Password
                if (empty($data['password'])) {
                    $data['password_err'] = 'Pleae enter password';
                } elseif (strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password must be at least 6 characters';
                }

                // Validate Confirm Password
                if (empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'Pleae confirm password';
                }

                if ($data['password'] !== $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }

                // Make sure errors are empty
                if (empty($data['email_err']) && empty($data['name_err']) && empty($data['gender_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                    // Validated

                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    if ($this->jobseekerModel->register($data)) {
                        // flash('register_success', 'You are registered and can log in');
                        $id = $this->jobseekerModel->getUserId($data['email']);
                        $this->verify_code($id->id, 'seeker', $data['email'], $data['name']);
                        $_SESSION['verify_id'] = $id->id;
                        $_SESSION['verify_email'] = $data['email'];
                        $data['code_err'] = 'Please verify your account';
                        $this->view('jobseeker/verify', $data);
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('jobseeker/register', $data);
                }
            } else {
                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'gender_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'login_email' => '',
                    'login_password' => '',
                    'login_email_err' => '',
                    'login_password_err' => '',
                ];

                // Load view
                $this->view('jobseeker/register', $data);
            }
        }
    }

    public function verify()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['verify_id']) && isset($_SESSION['verify_email'])) {
                if (isset($_POST['code'])) {
                    $code = trim(htmlspecialchars($_POST['code']));
                    $id = $_SESSION['verify_id'];
                    if ($this->jobseekerModel->checkVerificationCode($id, 'seeker', $code)) {
                        $this->jobseekerModel->setVerified($id);
                        $loggedInUser = $this->jobseekerModel->getJobseekerById($id);
                        $this->createUserSession($loggedInUser);
                        redirect('jobseekers/dashboard');
                    } else {
                        $data['code_err'] = 'Invalid verification code';
                        $this->view('jobseeker/verify', $data);
                    }
                } else {
                    $data['code_err'] = 'Please enter verification code';
                    $this->view('jobseeker/verify', $data);
                }
            } else {
                redirect('jobseekers/login');
            }
        } else {
            $data = [
                'code_err' => '',
            ];
            $this->view('jobseeker/verify', $data);
        }
    }

    public function resend_code()
    {
        if (isset($_SESSION['verify_id']) && isset($_SESSION['verify_email'])) {
            $id = $_SESSION['verify_id'];
            $email = $_SESSION['verify_email'];
            $this->verify_code($id, 'seeker', $email, '');
            $data = [
                'code_err' => 'Verification code resent',
            ];
            $this->view('jobseeker/verify', $data);
        } else {
            redirect('jobseekers/login');
        }
    }

    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->dashboard();
        } else {
            // Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data

                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'gender_err' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'login_email' => trim(htmlspecialchars($_POST['login_email'])),
                    'login_password' => trim(htmlspecialchars($_POST['login_password'])),
                    'login_email_err' => '',
                    'login_password_err' => '',
                ];

                // Validate Email
                if (empty($data['login_email'])) {
                    $data['login_email_err'] = 'Pleae enter email';
                }

                // Validate Password
                if (empty($data['login_password'])) {
                    $data['login_password_err'] = 'Please enter password';
                }

                // Check for user/email
                if ($this->jobseekerModel->findUserByEmail($data['login_email'])) {
                    // User found
                } else {
                    // User not found
                    $data['login_email_err'] = 'No user found';
                }

                // Make sure errors are empty
                if (empty($data['login_email_err']) && empty($data['login_password_err'])) {
                    // Validated
                    // Check and set logged in user
                    $loggedInUser = $this->jobseekerModel->login($data['login_email'], $data['login_password']);

                    if ($loggedInUser) {
                        if ($loggedInUser->code_verified == 0) {
                            $this->verify_code($loggedInUser->id, 'seeker', $loggedInUser->email, $loggedInUser->username);
                            $_SESSION['verify_id'] = $loggedInUser->id;
                            $_SESSION['verify_email'] = $loggedInUser->email;
                            $data['code_err'] = 'Please verify your account';
                            $data['user'] = $loggedInUser;
                            $this->view('jobseeker/verify', $data);
                        } else {
                            $this->createUserSession($loggedInUser);
                        }
                    } else {
                        $data['login_password_err'] = 'Password incorrect';

                        $this->view('jobseeker/register', $data);
                    }
                } else {
                    // Load view with errors
                    $this->view('jobseeker/register', $data);
                }
            } else {
                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'gender_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'login_email' => '',
                    'login_password' => '',
                    'login_email_err' => '',
                    'login_password_err' => '',
                ];

                // Load view
                $this->view('jobseeker/register', $data);
            }
        }
    }

    private function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->username;
        redirect('jobseekers/dashboard');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('');
    }

    private function getJobSeekerProfileImage($id)
    {
        $profileImage = $this->jobseekerModel->getJobSeekerProfileImage($id);
        return $profileImage->profile_image;
    }

    private function alert_job_count($id)
    {
        $seeker = $this->jobseekerModel->getJobseekerById($id);
        $jobs = [];
        if ($seeker->is_complete == 0) {
            $jobs = $this->algorithmModel->match_keywords($id);
        } else if ($seeker->location_rec == 0) {
            $jobs = $this->algorithmModel->match_keywords($id);
        } else {
            $jobs = $this->algorithmModel->match_location($id);
            $jobs = array_merge($jobs, $this->algorithmModel->match_keywords($id));
        }
        return count($jobs);
    }

    public function dashboard()
    {
        $this->onlySeeker();
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {
            $id = $_SESSION['user_id'];
            $appliedCount = $this->applicationModel->appliedJobCount($id);
            $wishlistCount = $this->wishlistModel->wishlistedJobCount($id);
            $alertCount = $this->alert_job_count($id);
            $data = [
                'style' => 'jobseeker/dashboard.css',
                'title' => 'Dashboard',
                'header_title' => 'Dashboard',
                'profile_image' => $this->getJobSeekerProfileImage($_SESSION['user_id']),
                'applied_count' => $appliedCount,
                'wishlist_count' => $wishlistCount,
                'alert_count' => $alertCount
            ];

            $this->view('jobseeker/dashboard', $data);
        }
    }

    public function profile()
    {
        $this->onlySeeker();
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {
            $id = $_SESSION['user_id'];
            $seeker = $this->jobseekerModel->getJobseekerById($id);
            $data = [
                'style' => 'jobseeker/profile.css',
                'title' => 'Profile',
                'header_title' => 'Profile',
                'profile_image' => $this->getJobSeekerProfileImage($_SESSION['user_id']),
                'message' => '',
            ];
            if ($seeker->is_complete == 0) {
                $data['message'] = 'Please complete your profile to receive job alerts';
            }
            $this->view('jobseeker/profile', $data);
        }
    }

    public function wishlist($job_id = null, $action = null)
    {
        $this->onlySeeker();
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {

            $id = $_SESSION['user_id'];

            if ($action == 'delete') {

                $job_id_str = trim(htmlspecialchars($job_id));
                $job_id = (int)$job_id_str;

                $data = [
                    'style' => 'jobseeker/wishlist.css',
                    'title' => 'Wishlist',
                    'header_title' => 'Wishlist',
                    'job_id' => $job_id,
                    'seeker_id' => $_SESSION['user_id'],

                ];
                $this->wishlistModel->deleteFromList($data);
                $this->view('wishlist/confirm', $data);
            }

            $wishlist = $this->jobModel->getWishlist($id);

            $data = [
                'style' => 'jobseeker/wishlist.css',
                'title' => 'Wishlist',
                'header_title' => 'Wishlist',
                'wishlist' => $wishlist,
                'profile_image' => $this->getJobSeekerProfileImage($_SESSION['user_id'])
            ];
            $this->view('wishlist/index', $data);
        }
    }

    public function applications()
    {
        $this->onlySeeker();
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {
            $id = $_SESSION['user_id'];

            // Get the count of applied jobs for the current user
            $appliedCount = $this->applicationModel->appliedJobCount($id);

            // Fetch the list of applied jobs
            $applications = $this->jobModel->getApplication($id);

            $data = [
                'style' => 'jobseeker/applied.css',
                'title' => 'Applied Jobs',
                'header_title' => 'Applied Jobs',
                'application' => $applications,
                'applied_count' => $appliedCount, // Pass the applied job count to the view
                'profile_image' => $this->getJobSeekerProfileImage($_SESSION['user_id'])
            ];
            $this->view('jobseeker/jobs-applied', $data);
        }
    }



    public function jobalerts()
    {
        $this->onlySeeker();
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {
            $id = $_SESSION['user_id'];

            $seeker = $this->jobseekerModel->getJobseekerById($id);

            $jobs = [];

            if ($seeker->is_complete == 0) {
                jsflash('Please complete your profile to receive job alerts', 'jobseekers/profile');
            } else if ($seeker->location_rec == 0) {
                $jobs = $this->algorithmModel->match_keywords($id);
            } else {
                $jobs = $this->algorithmModel->match_location($id);
                $jobs = array_merge($jobs, $this->algorithmModel->match_keywords($id));
            }

            $data = [
                'style' => 'jobseeker/alerts.css',
                'title' => 'Jobs Alerts',
                'header_title' => 'Job Alerts',
                'profile_image' => $this->getJobSeekerProfileImage($_SESSION['user_id']),
                'jobs' => $jobs
            ];

            $this->view('jobseeker/jobalerts', $data);
        }
    }


    public function changepassword()
    {
        $this->onlySeeker();
        if (!isset($_SESSION['user_id'])) {
            $this->index();
        } else {

            // Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST data
                $old_password = trim(htmlspecialchars($_POST['old_password']));
                $new_password = trim(htmlspecialchars($_POST['new_password']));
                $confirm_password = trim(htmlspecialchars($_POST['confirm_password']));

                // Init data
                $data = [
                    'style' => 'jobseeker/pass.css',
                    'title' => 'Change Password',
                    'header_title' => 'Change Password',
                    'old_password' => $old_password,
                    'new_password' => $new_password,
                    'confirm_password' => $confirm_password,
                    'old_password_err' => '',
                    'new_password_err' => '',
                    'confirm_password_err' => '',
                    'profile_image' => $this->getJobseekerProfileImage($_SESSION['user_id'])
                ];

                // Validate Old Password
                $loggedInUser = $this->jobseekerModel->getJobseekerById($_SESSION['user_id']);
                if (!$loggedInUser || !password_verify($data['old_password'], $loggedInUser->password)) {
                    $data['old_password_err'] = 'Incorrect old password';
                }

                // Validate New Password
                if (empty($data['new_password'])) {
                    $data['new_password_err'] = 'Please enter a new password';
                } elseif (strlen($data['new_password']) < 6) {
                    $data['new_password_err'] = 'Password must be at least 6 characters';
                }

                // Validate Confirm Password
                if ($data['new_password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }

                // If there are no errors, update the password
                if (empty($data['old_password_err']) && empty($data['new_password_err']) && empty($data['confirm_password_err'])) {
                    // Update the password in the database
                    $seeker_id = $_SESSION['user_id'];
                    if ($this->jobseekerModel->changePassword($seeker_id, $new_password)) {
                        jsflash('Password Updated', '/jobseeker/dashboard');
                    } else {
                        jsflash('Password update failed', '/jobseeker/changepassword');
                    }
                } else {
                    // Load view with errors
                    $this->view('jobseeker/changepassword', $data);
                }
            } else {
                // Init data
                $data = [
                    'style' => 'jobseeker/pass.css',
                    'title' => 'Change Password',
                    'header_title' => 'Change Password',
                    'old_password' => '',
                    'new_password' => '',
                    'confirm_password' => '',
                    'old_password_err' => '',
                    'new_password_err' => '',
                    'confirm_password_err' => '',
                    'profile_image' => $this->getJobSeekerProfileImage($_SESSION['user_id'])
                ];

                // Load view
                $this->view('jobseeker/changepassword', $data);
            }
        }
    }

    public function chat()
    {
        $this->onlySeeker();
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {
            $data = [
                'style' => 'jobseeker/chat.css',
                'title' => 'Chat',
                'header_title' => 'Chat With Recruiters',
                'profile_image' => $this->getJobSeekerProfileImage($_SESSION['user_id'])
            ];

            $this->view('jobseeker/chat', $data);
        }
    }

    public function edit_profile()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $data = [
                'id' => $_SESSION['user_id'],
                'username' => '',
                'gender' => '',
                'website' => '',
                'phone_no' => '',
                'location_rec' => '',
                'age' => '',
                'address' => '',
                'about' => '',
                'keywords' => '',
                'linkedin_url' => '',
                'whatsapp_url' => '',
            ];

            $filteredData = array_map('trim', array_map('htmlspecialchars', $_POST));
            // Update $data with sanitized values from $_POST
            $data = array_merge($data, $filteredData);

            if (empty($data['keywords']) || empty($data['address'])) {
                $data['data_err'] = 'Keywords and address cannot be empty.';
                jsflash($data['data_err'], 'jobseekers/profile', 1);
                return; // Stop further execution
            }

            if (!empty($_FILES['profile_image']['name'])) {
                $profileImagePath = $this->upload_media("profile_image", $_FILES, "/img/profile/", ['jpg', 'jpeg', 'png'], 1000000);

                // If profile image is uploaded, add it to $data
                if ($profileImagePath) {
                    $data['profile_image'] = $profileImagePath;
                } else {
                    $data['data_err'] = 'Image upload failed (check image extension or size)';
                    jsflash($data['data_err'], 'jobseekers/profile', 1);
                    return; // Stop further execution
                }
            } else {
                $data['profile_image'] = '';
            }

            if (!empty($_FILES['cv']['name'])) {
                $cvPath = $this->upload_media("cv", $_FILES, "/assets/cvs/", ['pdf'], 2000000);
                // If cv is uploaded, add it to $data
                if ($cvPath) {
                    $data['cv'] = $cvPath;
                } else {
                    $data['data_err'] = 'CV upload failed (check file extension or size)';
                    jsflash($data['data_err'], 'jobseekers/profile', 1);
                    return; // Stop further execution
                }
            } else {
                $data['cv'] = '';
            }

            // Call the model function to edit profile
            if ($this->jobseekerModel->editProfile($data)) {
                // Profile updated successfully
                $this->jobseekerModel->completeProfile($data['id']);
                jsflash('Profile Updated', 'jobseekers/profile');
            } else {
                // Handle error
                jsflash($data['data_err'], 'jobseekers/profile');
            }
        } else {
            // If not a POST request, redirect to profile page
            redirect('jobseekers/profile');
        }
    }
}
