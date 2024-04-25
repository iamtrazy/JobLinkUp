<?php
class Jobseekers extends Controller
{

    public $jobseekerModel;
    public $jobModel;
    public $wishlistModel;
    public $applicationModel;

    public function __construct()
    {
        $this->jobseekerModel = $this->model('Jobseeker');
        $this->jobModel = $this->model('Job');
        $this->wishlistModel = $this->model('Wishlist');
        $this->applicationModel = $this->model('Application');
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

                if (empty($data['gender'] || $data['gender'] !== 'male' || $data['gender'] !== 'female')) {
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

                    // Register User
                    if ($this->jobseekerModel->register($data)) {
                        flash('register_success', 'You are registered and can log in');
                        redirect('jobseekers/login');
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
                        // Create Session
                        $this->createUserSession($loggedInUser);
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

    private function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getJobSeekerProfileImage($id)
    {
        $profileImage = $this->jobseekerModel->getJobSeekerProfileImage($id);
        return $profileImage->profile_image;
    }

    public function dashboard()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {
            $data = [
                'style' => 'jobseeker/dashboard.css',
                'title' => 'Dashboard',
                'header_title' => 'Dashboard',
                'profile_image' => $this->getJobSeekerProfileImage($_SESSION['user_id'])
            ];

            $this->view('jobseeker/dashboard', $data);
        }
    }

    public function profile()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {
            $data = [
                'style' => 'jobseeker/profile.css',
                'title' => 'Profile',
                'header_title' => 'Profile',
                'profile_image' => $this->getJobSeekerProfileImage($_SESSION['user_id'])
            ];

            $this->view('jobseeker/profile', $data);
        }
    }

    public function wishlist($job_id = null, $action = null)
    {
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
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {
            $data = [
                'style' => 'jobseeker/alerts.css',
                'title' => 'Jobs Alerts',
                'header_title' => 'Job Alerts',
                'profile_image' => $this->getJobSeekerProfileImage($_SESSION['user_id'])
            ];

            $this->view('jobseeker/jobalerts', $data);
        }
    }


    public function changePassword()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {
            $data = [
                'style' => 'jobseeker/pass.css',
                'title' => 'Change Password',
                'header_title' => 'Change Password',
                'profile_image' => $this->getJobSeekerProfileImage($_SESSION['user_id'])
            ];

            $this->view('jobseeker/changepassword', $data);
        }
    }

    public function chat()
    {
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

            if (!empty($_FILES['profile_image']['name'])) {
                $profileImagePath = $this->upload_media("profile_image", $_FILES, "/img/profile/", ['jpg', 'jpeg', 'png'], 1000000);

                // If profile image is uploaded, add it to $data
                if ($profileImagePath) {
                    $data['profile_image'] = $profileImagePath;
                } else {
                    $data['data_err'] = 'Image upload failed (check image extension or size)';
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
                }
            } else {
                $data['cv'] = '';
            }
            // Call the model function to edit profile
            if ($this->jobseekerModel->editProfile($data)) {
                // Profile updated successfully
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
    public function explore(){
        $all_seekers = $this->jobseekerModel->getAll($data);
        $data=[
            'all_seekers'=> $all_seekers,
            'style' => 'jobseeker/explore.css',
            'title' => 'Job Seekers | Explore',
            'header_title' => 'Explore',

        ];
        $this->view('jobseeker/explore', $data);

    }
}
