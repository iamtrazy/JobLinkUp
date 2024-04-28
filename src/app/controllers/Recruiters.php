<?php
class Recruiters extends Controller
{

    public $recruiterModel;
    public $jobModel;
    public $applicationModel;
    public $chatModel;
    public $payhereModel;

    public function __construct()
    {
        $this->recruiterModel = $this->model('Recruiter');
        $this->jobModel = $this->model('Job');
        $this->applicationModel = $this->model('Application');
        $this->chatModel = $this->model('Chat');
        $this->payhereModel = $this->model('Payhere');
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

        if (isset($_SESSION['business_id'])) {
            $this->dashboard();
        } else {
            $this->view('recruiters/register', $data);
        }
    }


    private function verify_code($role_id, $role, $receiver, $receiver_name)
    {
        $this->recruiterModel->generateVerificationCode($role_id, $role);
        $code = $this->recruiterModel->getVerificationCode($role_id, $role);
        $subject = 'Verification Code';
        $body_string = 'Your verification code is: ' . $code->code;
        send_email($receiver, $receiver_name,  $subject, $body_string);
    }

    public function register()
    {

        if (isset($_SESSION['business_id'])) {
            $this->dashboard();
        } else {
            // Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Init data
                $data = [
                    'name' => trim(htmlspecialchars($_POST['name'])),
                    'email' => trim(htmlspecialchars($_POST['email'])),
                    'password' => trim(htmlspecialchars($_POST['password'])),
                    'confirm_password' => trim(htmlspecialchars($_POST['confirm_password'])),
                    'name_err' => '',
                    'email_err' => '',
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
                    if ($this->recruiterModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                // Validate Name
                if (empty($data['name'])) {
                    $data['name_err'] = 'Pleae enter name';
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
                } else {
                    if ($data['password'] != $data['confirm_password']) {
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                }

                // Make sure errors are empty
                if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                    // Validated

                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Register User
                    if ($this->recruiterModel->register($data)) {
                        // flash('register_success', 'You are registered and can log in');
                        $id = $this->recruiterModel->getUserId($data['email']);
                        $this->verify_code($id->id, 'recruiter', $data['email'], $data['name']);
                        $_SESSION['verify_id'] = $id->id;
                        $_SESSION['verify_email'] = $data['email'];
                        $data['code_err'] = 'Please verify your account';
                        $this->view('recruiters/verify', $data);
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('recruiters/register', $data);
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
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'login_email' => '',
                    'login_password' => '',
                    'login_email_err' => '',
                    'login_password_err' => '',
                ];

                // Load view
                $this->view('recruiters/register', $data);
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
                    if ($this->recruiterModel->checkVerificationCode($id, 'recruiter', $code)) {
                        $this->recruiterModel->setVerified($id);
                        $loggedInUser = $this->recruiterModel->getrecruiterById($id);
                        $this->createUserSession($loggedInUser);
                        redirect('recruiters/dashboard');
                    } else {
                        $data['code_err'] = 'Invalid verification code';
                        $this->view('recruiter/verify', $data);
                    }
                } else {
                    $data['code_err'] = 'Please enter verification code';
                    $this->view('recruiter/verify', $data);
                }
            } else {
                redirect('recruiters/login');
            }
        } else {
            $data = [
                'code_err' => '',
            ];
            $this->view('jobseeker/verify', $data);
        }
    }

    public function login()
    {
        if (isset($_SESSION['business_id'])) {
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
                    $data['login_email_err'] = 'Please enter email';
                }

                // Validate Password
                if (empty($data['login_password'])) {
                    $data['login_password_err'] = 'Please enter password';
                }

                // Check for user/email
                if ($this->recruiterModel->findUserByEmail($data['login_email'])) {
                    // User found
                } else {
                    // User not found
                    $data['login_email_err'] = 'No user found';
                }

                // Make sure errors are empty
                if (empty($data['login_email_err']) && empty($data['login_password_err'])) {
                    // Validated
                    // Check and set logged in user
                    $loggedInUser = $this->recruiterModel->login($data['login_email'], $data['login_password']);

                    if ($loggedInUser) {
                        if ($loggedInUser->code_verified == 0) {
                            $this->verify_code($loggedInUser->id, 'recruiter', $loggedInUser->email, $loggedInUser->name);
                            $_SESSION['verify_id'] = $loggedInUser->id;
                            $_SESSION['verify_email'] = $loggedInUser->email;
                            $data['code_err'] = 'Please verify your account';
                            $data['user'] = $loggedInUser;
                            $this->view('recruiters/verify', $data);
                        } else {
                            $this->createUserSession($loggedInUser);
                        }
                    } else {
                        $data['login_password_err'] = 'Password incorrect';

                        $this->view('recruiters/register', $data);
                    }
                } else {
                    // Load view with errors
                    $this->view('recruiters/register', $data);
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
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'login_email' => '',
                    'login_password' => '',
                    'login_email_err' => '',
                    'login_password_err' => '',
                ];

                // Load view
                $this->view('recruiters/register', $data);
            }
        }
    }

    private function createUserSession($user)
    {
        $_SESSION['business_id'] = $user->id;
        $_SESSION['business_email'] = $user->email;
        $_SESSION['business_name'] = $user->name;
        redirect('recruiters/dashboard');
    }

    public function logout()
    {
        unset($_SESSION['business_id']);
        unset($_SESSION['business_email']);
        unset($_SESSION['business_name']);
        session_destroy();
        redirect('');
    }

    private function isLoggedIn()
    {
        if (isset($_SESSION['business_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getRecruiterProfileImage($id)
    {
        $profileImage = $this->recruiterModel->getRecruiterProfileImage($id);
        return $profileImage;
    }

    public function changepassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'style' => 'jobseeker/pass.css',
                'title' => 'Change Password',
                'header_title' => 'Change Password',
                'old_password' => trim(htmlspecialchars($_POST['old_password'])),
                'new_password' => trim(htmlspecialchars($_POST['new_password'])),
                'confirm_password' => trim(htmlspecialchars($_POST['confirm_password'])),
                'old_password_err' => '',
                'new_password_err' => '',
                'confirm_password_err' => '',
                'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
            ];


            // Validate Old Password
            $loggedInUser = $this->recruiterModel->getRecruiterById($_SESSION['business_id']);
            if (!$loggedInUser || !password_verify($data['old_password'], $loggedInUser->password)) {
                $data['old_password_err'] = 'Incorrect old password';
            }

            // Validate new password
            if (empty($data['new_password'])) {
                $data['new_password_err'] = 'Please enter new password';
            } elseif (strlen($data['new_password']) < 6) {
                $data['new_password_err'] = 'Password must be at least 6 characters';
            }

            // Validate confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } elseif ($data['new_password'] !== $data['confirm_password']) {
                $data['confirm_password_err'] = 'Passwords do not match';
            }

            // Make sure errors are empty
            if (empty($data['old_password_err']) && empty($data['new_password_err']) && empty($data['confirm_password_err'])) {
                // Validated
                // Hash password
                $data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);

                // Update password
                if ($this->recruiterModel->changePassword($_SESSION['business_id'], $data['new_password'])) {
                    jsflash('Password Updated', '/recruiters/changepassword');
                } else {
                    jsflash('Failed to update password', '/recruiters/changepassword', 1);
                }
            } else {
                // Load view with errors
                $this->view('recruiters/changepassword', $data);
            }
        } else {
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
                'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
            ];
            $this->view('recruiters/changepassword', $data);
        }
    }

    public function dashboard()
    {
        if (!isset($_SESSION['business_id'])) {
            $this->login();
        } else {
            $data = [
                'total_jobs' => $this->recruiterModel->postedJobCount($_SESSION['business_id']),
                'total_applications' => $this->recruiterModel->pendingApplicationsCount($_SESSION['business_id']),
                'total_views' => $this->recruiterModel->totalViewsCount($_SESSION['business_id']),
                'style' => 'recruiter/dashboard.css',
                'title' => 'Dashboard',
                'header_title' => 'Dashboard',
                'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
            ];
        }

        $this->view('recruiters/dashboard', $data);
    }


    public function postjob()
    {
        $data = [
            'style' => 'recruiter/postjob.css',
            'title' => 'Post A Job',
            'header_title' => 'Post A Job',
            'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
        ];

        $this->view('recruiters/postjob', $data);
    }

    public function editjob($job_id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'topic' => trim(htmlspecialchars($_POST['topic'])),
                'location' => trim(htmlspecialchars($_POST['location'])),
                'type' => trim(htmlspecialchars($_POST['type'])),
                'rate' => trim(htmlspecialchars($_POST['rate'])),
                'rate_type' => trim(htmlspecialchars($_POST['rate_type'])),
                'website' => trim(htmlspecialchars($_POST['website'])),
                'keywords' => trim(htmlspecialchars($_POST['keywords'])),
                'detail' => trim(htmlspecialchars($_POST['detail'])),
                'job_id' => $job_id
            ];

            // Check if the current user is authorized to edit this job
            $job = $this->jobModel->getJobById($job_id);
            if ($job->recruiter_id !== $_SESSION['business_id']) {
                $response = ['status' => 'error', 'message' => 'You are not authorized to edit this job'];
            } else {
                // Handle file upload if banner image is set
                if (isset($_FILES['banner_image'])) {
                    $bannerImagePath = $this->upload_media("banner_image", $_FILES, "/img/job_banner/", ['jpg', 'jpeg', 'png'], 1000000);

                    // If banner image is uploaded, add it to $data
                    if ($bannerImagePath) {
                        $data['banner_image'] = $bannerImagePath;
                    } else {
                        $response = ['status' => 'error', 'message' => 'Image upload failed (check image extension or size)'];
                    }
                }

                // Validate required fields
                if (empty($data['rate']) || empty($data['location']) || empty($data['topic']) || empty($data['type']) || empty($data['detail'])) {
                    $response = ['status' => 'error', 'message' => 'Please enter all details'];
                } else {
                    // Update the job
                    if ($this->jobModel->updateJob($data)) {
                        $response = ['status' => 'success', 'message' => 'Job Updated Successfully'];
                    } else {
                        $response = ['status' => 'error', 'message' => 'Failed to update job'];
                    }
                }
            }

            // Return JSON response
            $this->view('api/json', $response);
        } else {
            // If GET request, load the job data for editing
            if ($job = $this->jobModel->getJobById($job_id)) {
                $data = [
                    'job' => $job,
                    'style' => 'recruiter/postjob.css',
                    'title' => 'Edit Job',
                    'header_title' => 'Edit Job',
                    'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
                ];
                $this->view('recruiters/edit-job', $data);
            } else {
                $data = [
                    'style' => 'recruiter/postjob.css',
                    'title' => 'Edit Job',
                    'header_title' => 'Edit Job',
                    'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
                ];
                $this->view('recruiters/postjob', $data);
            }
        }
    }

    public function deletejob($job_id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $job = $this->jobModel->getJobById($job_id);
            if ($job->recruiter_id !== $_SESSION['business_id']) {
                $response = ['status' => 'error', 'message' => 'You are not authorized to delete this job'];
            } else {
                if ($this->jobModel->deleteJob($job_id)) {
                    $response = ['status' => 'success', 'message' => 'Job Deleted Successfully'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Failed to delete job'];
                }
            }

            $this->view('api/json', $response);
        }
    }

    public function chat()
    {
        $data = [
            'style' => 'recruiter/chat.css',
            'title' => 'Chat',
            'header_title' => 'Chat With Job Seekers',
            'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
        ];

        $this->view('recruiters/chat', $data);
    }


    public function transactions()
    {

        if ($this->recruiterModel->isVerified($_SESSION['business_id'])) {
            $data = [
                'style' => 'recruiter/pay.css',
                'title' => 'Verified Business',
                'header_title' => 'Varified Business',
                'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
            ];
            $this->view('recruiters/verified', $data);;
        } else if ($this->recruiterModel->isPaid($_SESSION['business_id'])) {
            $data = [
                'style' => 'recruiter/pay.css',
                'title' => 'Pending Verification',
                'header_title' => 'Pending Verification',
                'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
            ];
            $this->view('recruiters/pending', $data);
        } else if ($this->recruiterModel->isBrUploaded($_SESSION['business_id'])) {
            $this->pay();
        } else {
            $data = [
                'style' => 'recruiter/transactions.css',
                'title' => 'Verify Business Profile',
                'header_title' => 'Verify Your Business',
                'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
            ];

            $this->view('recruiters/transactions', $data);
        }
    }

    public function profile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_SESSION['business_id'],
                'name' => trim(htmlspecialchars($_POST['name'])),
                'phone_no' => trim(htmlspecialchars($_POST['phone_no'])),
                'age' => trim(htmlspecialchars($_POST['age'])),
                'address' => trim(htmlspecialchars($_POST['address'])),
                'about' => trim(htmlspecialchars($_POST['about'])),
                'whatsapp_url' => trim(htmlspecialchars($_POST['whatsapp_url'])),
                'linkedin_url' => trim(htmlspecialchars($_POST['linkedin_url'])),
                'business_id' => $_SESSION['business_id']
            ];

            // Handle file upload if profile image is set
            if (isset($_FILES['profile_image']['name'])) {
                $profileImagePath = $this->upload_media("profile_image", $_FILES, "/img/profile/", ['jpg', 'jpeg', 'png'], 1000000);

                // If profile image is uploaded, add it to $data
                if ($profileImagePath) {
                    $data['profile_image'] = $profileImagePath;
                } else {
                    jsflash('Image upload failed (check image extension or size)', '/recruiters/profile', 1);
                }
            }
            // Validate required fields
            if (empty($data['name']) || empty($data['phone_no']) || empty($data['age']) || empty($data['address'])) {
                jsflash('Please enter all details', '/recruiters/profile', 1);
            } else {
                // Update the profile
                if ($this->recruiterModel->updateProfile($data)) {
                    jsflash('Profile Updated Successfully', '/recruiters/profile');
                } else {
                    jsflash('Failed to update profile', '/recruiters/profile', 1);
                }
            }
        } else {
            $data = [
                'style' => 'recruiter/profile.css',
                'title' => 'Profile',
                'header_title' => 'Recruiter Profile',
                'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
            ];

            $this->view('recruiters/profile', $data);
        }
    }

    public function manage()
    {
        $jobs  = $this->jobModel->getRecruiterJobs($_SESSION['business_id']);
        $data = [
            'jobs' => $jobs,
            'style' => 'recruiter/manage.css',
            'title' => 'Manage',
            'header_title' => 'Manage jobs',
            'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
        ];

        $this->view('recruiters/manage', $data);
    }


    public function applications($job_id = null)
    {
        $applications = $this->applicationModel->getApplications($job_id);
        $data = [
            'style' => 'recruiter/applications.css',
            'title' => 'Candidates',
            'header_title' => 'Candidates',
            'applications' => $applications,
            'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
        ];

        $this->view('recruiters/applications', $data);
    }

    public function acceptApplication()
    {
        // Check if request is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if ($this->isLoggedIn()) {
                // Get application ID from POST data
                $job_id = $_POST['job_id'];
                $seeker_id = $_POST['seeker_id'];

                // Perform accept action
                if ($this->applicationModel->acceptApplication($seeker_id, $job_id)) {
                    // Return success message
                    $message = 'Application accepted successfully';
                    if ($this->chatModel->checkThreadExists($seeker_id, $_SESSION['business_id'])) {
                        $this->chatModel->startThread($seeker_id, $_SESSION['business_id']);
                    }
                } else {
                    // Return error message
                    $message = 'Failed to accept application';
                }
            } else {
                // Return error message if user is not logged in
                $message = 'User not logged in';
            }
        } else {
            // Return error message if request method is not POST
            $message = 'Invalid request method';
        }

        // Load 'api/json' view with the message
        $this->view('api/json', ['message' => $message]);
    }


    public function rejectApplication()
    {
        // Check if request is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if ($this->isLoggedIn()) {
                // Get application ID from POST data
                $seeker_id = $_POST['seeker_id'];
                $job_id = $_POST['job_id'];

                // Perform reject action
                if ($this->applicationModel->rejectApplication($seeker_id, $job_id)) {
                    // Return success message
                    if ($this->chatModel->checkThreadExists($seeker_id, $_SESSION['business_id'])) {
                        $thread_id = $this->chatModel->getThreadId($seeker_id, $_SESSION['business_id']);
                        $this->chatModel->deleteThread($thread_id);
                    }
                    $message = 'Application rejected successfully';
                } else {
                    // Return error message
                    $message = 'Failed to reject application';
                }
            } else {
                // Return error message if user is not logged in
                $message = 'User not logged in';
            }
        } else {
            // Return error message if request method is not POST
            $message = 'Invalid request method';
        }

        // Load 'api/json' view with the message
        $this->view('api/json', ['message' => $message]);
    }


    public function applyForBR()
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Initialize an empty array to store response data
            $response = [];

            // Check if the user is logged in
            if ($this->isLoggedIn()) {
                // Validate and process the form data
                // You can access the form fields using $_POST superglobal
                // For example:
                if ($_POST['agree_tos'] == 1) {
                    // Sanitize and validate the form data (business name, type, registration number, business address, and BR file
                    $business_name = trim($_POST['business_name']);
                    $business_type = trim($_POST['type']);
                    $registration_number = trim($_POST['reg_no']);
                    $business_address = trim($_POST['location']);
                    $recruiter_id = $_SESSION['business_id'];
                    $first_name = trim($_POST['first_name']);
                    $last_name = trim($_POST['last_name']);
                    $phone = trim($_POST['phone']);
                    $city = trim($_POST['city']);
                    $address = trim($_POST['address']);

                    if (!empty($_FILES['br'])) {
                        $br_path = $this->upload_media("br", $_FILES, "/assets/brs/", ['pdf'], 2000000);

                        // If profile image is uploaded, add it to $data
                        if ($br_path) {
                            $br = $br_path;
                        } else {
                            $response['status'] = 'error';
                            $response['message'] = 'BR upload failed (check file extension or size)';
                        }
                    } else {
                        $br = '';
                    }
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Please agree to the terms of service';
                }
                if (empty($business_name) || empty($business_type) || empty($registration_number) || empty($business_address) || empty($br)) {
                    $response['status'] = 'error';
                    $response['message'] = 'Please enter all details';
                } else {
                    // Save the business registration data
                    if ($this->recruiterModel->applyForBR($recruiter_id, $business_name, $business_type, $registration_number, $business_address, $br)) {
                        $response['status'] = 'success';
                        $response['message'] = 'Business registration request submitted successfully';
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Failed to submit business registration request';
                    }
                }
            } else {
                // If the user is not logged in, return an error message
                $response['status'] = 'error';
                $response['message'] = 'User not logged in';
            }
        } else {
            // If the request method is not POST, return an error message
            $response['status'] = 'error';
            $response['message'] = 'Invalid request method';
        }


        // Send the JSON response
        $this->view('api/json', $response);
    }

    public function explore()
    {
        $all_recruiters = $this->recruiterModel->getAll();
        $data = [
            'style' => 'recruiter/explore.css',
            'title' => 'Recruiters Grid',
            'header_title' => 'Explore',
            'all_recruiters' => $all_recruiters,

        ];
        $this->view('recruiters/explore', $data);
    }

    public function pay()
    {
        $br = $this->recruiterModel->getBrDetails($_SESSION['business_id']);
        $email = $this->recruiterModel->getRecruiterEmail($_SESSION['business_id']);
        $payment = $this->payhereModel->premium($br->phone, $br->address, $br->city, $br->first_name, $br->last_name, $email);

        // $recruiter = $this->recruiterModel->getRecruiterById($_SESSION['business_id']);
        $data = [
            'style' => 'recruiter/pay.css',
            'title' => 'Verify Your Business',
            'header_title' => 'Verify Your Business',
            'payment' => $payment,

        ];

        $this->view('recruiters/pay', $data);
    }

    public function pay_success()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recruiter_id = $_SESSION['business_id'];
            if ($this->recruiterModel->paySuccess($recruiter_id)) {
                $response = ['status' => 'success', 'message' => 'Payment successful'];
            } else {
                $response = ['status' => 'error', 'message' => 'Failed to update payment status'];
            }
        }
        $this->view('api/json', $response);
    }

    public function public_profile($id = null)
    {
        //   if (!isset($_SESSION['business_id'])) {
        //     $_SESSION['guest_id'] = '1';
        //     $_SESSION['user_name'] = 'Guest User';
        //   }

        // Check if $id is provided and is not null
        if ($id !== null) {
            // Retrieve recruiter details for the given $id

            // $profile = $this->candidateModel->getCandidateById($id);
            $profile = $this->recruiterModel->getRecruiterById($id);


            if (($profile->address) !== null) {
                $locationData = gelocate($profile->address);
                if ($locationData === null) {
                    $profile->country = 'unknown';
                    $profile->city = 'unknown';
                }
                $profile->country = $locationData['country'];
                $profile->city = $locationData['city'];
            } else {
                $profile->country = 'unknown';
                $profile->city = 'unknown';
            }

            // Check if job details are retrieved successfully
            if ($profile) {
                // Prepare data to pass to the view
                $data = [
                    'style' => 'candidates/profile.css',
                    'title' => 'Recruiter Details',
                    'header_title' => 'Recruiter Details',
                    'profile' => $profile // Pass job details to the view
                ];

                // Load the detail view with job details
                $this->view('recruiters/public_profile', $data);
            } else {
                // Handle case when job details are not found
                // You can display an error message or redirect to a different page
                jsflash('Recruiter not found', 'jobs');
            }
        } else {
            // Handle case when $id is not provided or is null
            // You can display an error message or redirect to a different page
            jsflash('recruiter not found', 'jobs');
        }
    }
}
