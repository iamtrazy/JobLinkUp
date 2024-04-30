<?php
class Admins extends Controller
{

    public $adminModel;
    public $moderatorModel;

    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
        $this->moderatorModel = $this->model('Moderator');
    }

    public function index()
    {
        $data = [
            'style' => 'moderators/login.css',
            'title' => 'Admin Login',
            'login_email' => '',
            'login_password' => '',
            'login_email_err' => '',
            'login_password_err' => ''
        ];

        if (isset($_SESSION['admin_id'])) {
            $this->dashboard();
        } else {
            $this->view('admin/login', $data);
        }
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

    private function onlyAdmin(){
        if($this->whichUser() != 'admin'){
            redirect('/admins/login');
        }
    }

    public function login()
    {
        if (isset($_SESSION['admin_id'])) {
            // $this->dashboard();
        } else {
            // Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data

                // Init data
                $data = [
                    'style' => 'moderators/login.css',
                    'title' => 'Admin Login',
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
                if ($this->adminModel->findUserByEmail($data['login_email'])) {
                    // User found
                } else {
                    // User not found
                    $data['login_email_err'] = 'No user found';
                }

                // Make sure errors are empty
                if (empty($data['login_email_err']) && empty($data['login_password_err'])) {
                    // Validated
                    // Check and set logged in user
                    $loggedInUser = $this->adminModel->login($data['login_email'], $data['login_password']);

                    if ($loggedInUser) {
                        // Create Session
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['login_password_err'] = 'Password incorrect';

                        $this->view('admin/login', $data);
                    }
                } else {
                    // Load view with errors
                    $this->view('admin/login', $data);
                }
            } else {
                // Init data
                $data = [
                    'login_email' => '',
                    'login_password' => '',
                    'login_email_err' => '',
                    'login_password_err' => '',
                ];

                // Load view
                $this->view('admin/login', $data);
            }
        }
    }

    private function createUserSession($user)
    {
        $_SESSION['admin_id'] = $user->id;
        $_SESSION['admin_email'] = $user->email;
        $_SESSION['admin_name'] = $user->name;
        redirect('admins/dashboard');
    }

    public function logout()
    {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_email']);
        unset($_SESSION['admin_name']);
        session_destroy();
        redirect('admins');
    }

    private function isLoggedIn()
    {
        if (isset($_SESSION['admin_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function dashboard()
    {
        $this->onlyAdmin();

        $total_jobs = $this->adminModel->countJobs();
        $total_recruiters = $this->adminModel->countRecruiters();
        $total_jobseekers = $this->adminModel->countJobseekers();
        $total_income = $this->adminModel->totalIncome();

        if (!isset($_SESSION['admin_id'])) {
            $this->index();
        } else {
            $data = [
                'style' => 'admin/dashboard.css',
                'title' => 'Dashboard',
                'header_title' => 'Dashboard',
                'total_jobs' => $total_jobs,
                'total_recruiters' => $total_recruiters,
                'total_jobseekers' => $total_jobseekers,
                'total_income' => $total_income
            ];

            $this->view('admin/dashboard', $data);
        }
    }

    public function addadmin()
    {
        $this->onlyAdmin();
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Init data
            $data = [
                'style' => 'recruiter/postjob.css',
                'title' => 'Add a Moderator',
                'header_title' => 'Add a Moderator',
                'name' => trim(htmlspecialchars($_POST['name'])),
                'email' => trim(htmlspecialchars($_POST['email'])),
                'password' => trim(htmlspecialchars($_POST['password'])),
                'confirm_password' => trim(htmlspecialchars($_POST['confirm_password'])),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Pleae enter email';
            } else {
                // Check email
                if ($this->adminModel->findModeratorByEmail($data['email'])) {
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

                $password = $data['password'];
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if ($this->adminModel->addadmin($data)) {
                    $email_body = 'Your account has been created. You can login at ' . URLROOT . '/moderators' . ' with your email and below password. <br> Password: ' . $password . '<br> Please change your password after logging in.';
                    send_email($data['email'], $data['name'],'Moderator Account Created', $email_body);
                    jsflash('Moderator Added', 'admins/managemoderators');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('admin/addadmin', $data);
            }
        } else {
            // Init data
            $data = [
                'style' => 'recruiter/postjob.css',
                'title' => 'Add a Moderator',
                'header_title' => 'Add a Moderator',
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view
            $this->view('admin/addadmin', $data);
        }
    }

    public function transactions()
    {
        $this->onlyAdmin();
        $br_details = $this->moderatorModel->getAllBRDetails();
        $data = [
            'style' => 'moderators/verify_BR.css',
            'title' => 'BR verification',
            'header_title' => 'Change Password',
            'BR_details' => $br_details
        ];
        $this->view('admin/verify', $data);
    }


    public function managemoderators()
    {
        $this->onlyAdmin();
        $moderators = $this->adminModel->getModeratorDetails();
        $data = [
            'style' => 'admin/mod_manage.css',
            'title' => 'Manage Moderators',
            'header_title' => 'Manage Moderators',
            'moderators' => $moderators
        ];
        // Load view
        $this->view('admin/managemoderators', $data);
    }

    public function disable_moderator()
    {
        $this->onlyAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if ($this->isLoggedIn()) {
                // Get moderator ID from POST data
                $moderator_id = trim(htmlspecialchars($_POST['moderator_id']));

                // Perform disable action
                if ($this->adminModel->deleteModerator($moderator_id)) {
                    // Return success message
                    $response = [
                        'status' => 'success',
                        'message' => 'Moderator disabled'
                    ];
                } else {
                    // Return error message
                    $response = [
                        'status' => 'error',
                        'message' => 'Failed to disable moderator'
                    ];
                }
            } else {
                // Return error message if user is not logged in
                $response = [
                    'status' => 'error',
                    'message' => 'User not logged in'
                ];
            }
        } else {
            // Return error message if request method is not POST
            $response = [
                'status' => 'error',
                'message' => 'Invalid request method'
            ];
        }

        // Load 'api/json' view with the response
        $this->view('api/json', $response);
    }

    public function enable_moderator()
    {
        $this->onlyAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if ($this->isLoggedIn()) {
                // Get moderator ID from POST data
                $moderator_id = trim(htmlspecialchars($_POST['moderator_id']));

                // Perform disable action
                if ($this->adminModel->restoreModerator($moderator_id)) {
                    // Return success message
                    $response = [
                        'status' => 'success',
                        'message' => 'Moderator enabled'
                    ];
                } else {
                    // Return error message
                    $response = [
                        'status' => 'error',
                        'message' => 'Failed to enable moderator'
                    ];
                }
            } else {
                // Return error message if user is not logged in
                $response = [
                    'status' => 'error',
                    'message' => 'User not logged in'
                ];
            }
        } else {
            // Return error message if request method is not POST
            $response = [
                'status' => 'error',
                'message' => 'Invalid request method'
            ];
        }

        // Load 'api/json' view with the response
        $this->view('api/json', $response);
    }

    public function ads()
    {
        $this->onlyAdmin();
        $data = [
            'style' => 'admin/ads.css',
            'title' => 'Ads',
            'header_title' => 'Ads'
        ];

        $this->view('admin/ads', $data);
    }

    public function post_ads()
    {
        $this->onlyAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->isLoggedIn()) {
                // Get application ID from POST data
                $admin_id = $_SESSION['admin_id'];
                $title = trim(htmlspecialchars($_POST['title']));
                $text = trim(htmlspecialchars($_POST['text']));
                $url = trim(htmlspecialchars($_POST['url']));
                $color = trim(htmlspecialchars($_POST['color']));
                $ad_id = trim(htmlspecialchars($_POST['ad_id']));
                if ($this->adminModel->updateAds($title, $text, $url, $color, $admin_id, $ad_id)) {
                    // Return success message
                    $response = [
                        'status' => 'success',
                        'message' => 'Ad updated'
                    ];
                } else {
                    // Return error message
                    $response = [
                        'status' => 'error',
                        'message' => 'Failed to update ad'
                    ];
                }
            } else {
                // Return error message if user is not logged in
                $response = [
                    'status' => 'error',
                    'message' => 'User not logged in'
                ];
            }
        } else {
            // Return error message if request method is not POST
            $response = [
                'status' => 'error',
                'message' => 'Invalid request method'
            ];
        }
        // Load 'api/json' view with the response
        $this->view('api/json', $response);
    }
    public function job_ad()
    {
        $this->onlyAdmin();
        $data['job_ad'] = $this->adminModel->jobAd();
        $this->view('api/json', $data);
    }
    public function candidate_ad()
    {
        $this->onlyAdmin();
        $data['candidate_ad'] = $this->adminModel->candidateAd();
        $this->view('api/json', $data);
    }

    public function dropbox()
    {
        $this->onlyAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->isLoggedIn()) {

                $admin_id = $_SESSION['admin_id'];
                if ($this->adminModel->isDropBoxKeysPresent($admin_id)) {
                    $client_id = trim(htmlspecialchars($_POST['client_id']));
                    $client_secret = trim(htmlspecialchars($_POST['client_secret']));
                    $access_token = trim(htmlspecialchars($_POST['access_token']));
                    if ($this->adminModel->updateDropBoxKeys($client_id, $client_secret, $access_token, $admin_id)) {
                        $response = [
                            'status' => 'success',
                            'message' => 'Dropbox keys updated'
                        ];
                    } else {
                        $response = [
                            'status' => 'error',
                            'message' => 'Failed to update Dropbox keys'
                        ];
                    }
                } else {
                    $client_id = trim(htmlspecialchars($_POST['client_id']));
                    $client_secret = trim(htmlspecialchars($_POST['client_secret']));
                    $access_token = trim(htmlspecialchars($_POST['access_token']));
                    if ($this->adminModel->addDropBoxKeys($client_id, $client_secret, $access_token, $admin_id)) {
                        $response = [
                            'status' => 'success',
                            'message' => 'Dropbox keys added'
                        ];
                    } else {
                        $response = [
                            'status' => 'error',
                            'message' => 'Failed to add Dropbox keys'
                        ];
                    }
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'User not logged in'
                ];
            }
            $this->view('api/json', $response);
        } else {
            $data = [
                'style' => 'admin/ads.css',
                'title' => 'Dropbox',
                'header_title' => 'Dropbox',
                'dropbox_keys' => ''
            ];
            $admin_id = $_SESSION['admin_id'];
            if ($this->adminModel->isDropBoxKeysPresent($admin_id)) {
                $data['dropbox_keys'] = $this->adminModel->getDropBoxKeys($admin_id);
            }
            $this->view('admin/dropbox', $data);
        }
    }

    public function backup()
    {
        $this->onlyAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->isLoggedIn()) {
                $backup = $this->adminModel->backups('/tmp');
                if ($backup) {
                    $file = '/tmp/' . $backup;
                    $dropbox_path = '/' . $backup;
                    $dropbox_keys = $this->adminModel->getDropBoxKeys($_SESSION['admin_id']);
                    if ($dropbox_keys) {
                        $client_id = $dropbox_keys->client_id;
                        $client_secret = $dropbox_keys->client_secret;
                        $access_token = $dropbox_keys->access_token;
                        if ($this->adminModel->upload_database($client_id, $client_secret, $access_token, $file, $dropbox_path)) {
                            $response = [
                                'status' => 'success',
                                'message' => 'Backup created and uploaded'
                            ];
                        } else {
                            $response = [
                                'status' => 'error',
                                'message' => 'Failed to upload backup'
                            ];
                        }
                    } else {
                        $response = [
                            'status' => 'error',
                            'message' => 'Dropbox keys not set'
                        ];
                    }
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Failed to create backup'
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'User not logged in'
                ];
            }
            $this->view('api/json', $response);
        } else {
            $data = [
                'style' => 'admin/ads.css',
                'title' => 'Backup',
                'header_title' => 'Backup'
            ];
            $this->view('admin/backup', $data);
        }
    }

    public function test_backup()
    {
        $backup = $this->adminModel->backups('/tmp');
        if ($backup) {
            echo 'Backup created';
        } else {
            echo 'Failed to create backup';
        }
        $file = '/tmp/' . $backup;
        $dropbox_path = '/' . $backup;

        $client_id = 'm91cjmivnpmg6rh';
        $client_secret = '6rs0z9ki0ylyv1t';
        $access_token = 'sl.B0OotKuStC6HHxbX7jYwLJp_tEYwe2i9GnUqpf4qfHXr9YkcjvVcvVXUB5ZxE-Bd0gOjtRQgDrZvYO7aTBqS7tUHhNxc7InFqmdFIfDOZ6vF7reZKTf3ZqztQKM6zZ-O_ecWBeCsqgAe';

        if ($this->adminModel->upload_database($client_id, $client_secret, $access_token, $file, $dropbox_path)) {
            echo 'Backup uploaded';
        } else {
            echo 'Failed to upload backup';
        }
    }
}
