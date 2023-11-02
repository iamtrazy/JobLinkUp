<?php
class Moderators extends Controller
{

    public $moderatorModel;

    public function __construct()
    {
        $this->moderatorModel = $this->model('Moderator');
    }

    public function index()
    {
        $data = [
            'style' => 'moderators/login.css',
            'title' => 'Moderator Login',
            'login_email' => '',
            'login_password' => '',
            'login_email_err' => '',
            'login_password_err' => '',
        ];

        if (isset($_SESSION['moderator_id'])) {
            // $this->dashboard();
        } else {
            $this->view('moderator/login', $data);
        }
    }

    public function login()
    {
        if (isset($_SESSION['moderator_id'])) {
            // $this->dashboard();
        } else {
            // Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data

                // Init data
                $data = [
                    'style' => 'moderators/login.css',
                    'title' => 'Moderator Login',
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
                if ($this->moderatorModel->findUserByEmail($data['login_email'])) {
                    // User found
                } else {
                    // User not found
                    $data['login_email_err'] = 'No user found';
                }

                // Make sure errors are empty
                if (empty($data['login_email_err']) && empty($data['login_password_err'])) {
                    // Validated
                    // Check and set logged in user
                    $loggedInUser = $this->moderatorModel->login($data['login_email'], $data['login_password']);

                    if ($loggedInUser) {
                        // Create Session
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['login_password_err'] = 'Password incorrect';

                        $this->view('moderator/login', $data);
                    }
                } else {
                    // Load view with errors
                    $this->view('moderator/login', $data);
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
                $this->view('moderator/login', $data);
            }
        }
    }

    private function createUserSession($user)
    {
        $_SESSION['moderator_id'] = $user->id;
        $_SESSION['moderator_email'] = $user->email;
        $_SESSION['moderator_name'] = $user->name;
        redirect('moderators/dashboard');
    }

    public function logout()
    {
        unset($_SESSION['moderator_id']);
        unset($_SESSION['moderator_email']);
        unset($_SESSION['moderator_name']);
        session_destroy();
        redirect('');
    }

    private function isLoggedIn()
    {
        if (isset($_SESSION['moderator_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
