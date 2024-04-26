<?php
class Admins extends Controller
{

    public $adminModel;
    public $moderatorsModel;

    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
        $this->moderatorsModel = $this->model('Moderator');
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
            // $this->dashboard();
        } else {
            $this->view('admin/login', $data);
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
        if (!isset($_SESSION['admin_id'])) {
            $this->index();
        } else {
            $data = [
                'style' => 'admin/dashboard.css',
                'title' => 'Dashboard',
                'header_title' => 'Dashboard'
            ];

            $this->view('admin/dashboard', $data);
        }
    }

    public function addadmin()
    {
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

                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if ($this->adminModel->addadmin($data)) {
                    jsflash('Moderator Added', 'admins/addadmin');
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
    {$data =[
        'style' => 'admin/dashboard.css',
        'title' => 'transactions',
        'header_title' => 'transactions',
    ];
    // Load view
    $this->view('admin/transactions', $data);
    }
    public function managemoderators()
    {
        $moderators =$this->adminModel-> getModeratorDetails();
        $data =[
        'style' => 'admin/dashboard.css',
        'title' => 'managemoderators',
        'header_title' => 'managemoderators',
        'moderators' => $moderators
    ];

    // Load view
    $this->view('admin/managemoderators', $data);
    }

}    