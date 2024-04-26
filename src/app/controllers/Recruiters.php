<?php
class Recruiters extends Controller
{

    public $recruiterModel;
    public $jobModel;
    public $applicationModel;
    public $chatModel;

    public function __construct()
    {
        $this->recruiterModel = $this->model('Recruiter');
        $this->jobModel = $this->model('Job');
        $this->applicationModel = $this->model('Application');
        $this->chatModel = $this->model('Chat');
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
                        flash('register_success', 'You are registered and can log in');
                        redirect('recruiters/login');
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
                        // Create Session
                        $this->createUserSession($loggedInUser);
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

    public function dashboard()
    {
        if (!isset($_SESSION['business_id'])) {
            $this->login();
        } else {
            $data = [
                'style' => 'recruiter/dashboard.css',
                'title' => 'Dashboard',
                'header_title' => 'Dashboard'
            ];
        }

        $this->view('recruiters/dashboard', $data);
    }


    public function postjob()
    {
        $data = [
            'style' => 'recruiter/postjob.css',
            'title' => 'Post A Job',
            'header_title' => 'Post A Job'
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
            $job = $this->jobModel->getJobById($job_id);
            $data = [
                'job' => $job,
                'style' => 'recruiter/postjob.css',
                'title' => 'Edit Job',
                'header_title' => 'Edit Job'
            ];

            $this->view('recruiters/edit-job', $data);
        }
    }


    public function chat()
    {
        $data = [
            'style' => 'recruiter/chat.css',
            'title' => 'Chat',
            'header_title' => 'Chat With Job Seekers'
        ];

        $this->view('recruiters/chat', $data);
    }


    public function transactions()
    {
        $data = [
            'style' => 'recruiter/transactions.css',
            'title' => 'Verify Business Profile',
            'header_title' => 'BR Verification'
        ];

        $this->view('recruiters/transactions', $data);
    }

    public function manage()
    {
        $jobs  = $this->jobModel->getRecruiterJobs($_SESSION['business_id']);
        $data = [
            'jobs' => $jobs,
            'style' => 'recruiter/manage.css',
            'title' => 'Manage',
            'header_title' => 'Manage jobs'
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
            'applications' => $applications
        ];

        $this->view('recruiters/applications', $data);
    }

    public function profile()
    {
        $data = [
            'style' => 'recruiter/profile.css',
            'title' => 'Profile',
            'header_title' => 'Recruiter Profile'
        ];

        $this->view('recruiters/profile', $data);
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
}
