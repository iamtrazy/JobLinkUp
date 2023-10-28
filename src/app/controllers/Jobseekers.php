<?php
class Jobseekers extends Controller
{

    public $jobseekerModel;

    public function __construct()
    {
        $this->jobseekerModel = $this->model('Jobseeker');
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

        $this->view('jobseeker/register', $data);
    }

    public function register()
    {
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
                if ($this->jobseekerModel->findUserByEmail($data['email'])) {
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

    public function login()
    {
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

                    $this->view('jobseeker/login', $data);
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

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->username;
        redirect('pages/index');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('jobseekers/login');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function dashboard(){
        $data = [
          'title' => 'JobLinkUp',
        ];
       
        $this->view('jobseeker/dashboard', $data);
    }

}
