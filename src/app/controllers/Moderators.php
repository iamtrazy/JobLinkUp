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
            $this->dashboard();
        } else {
            $this->view('moderator/login', $data);
        }
    }

    public function login()
    {
        if (isset($_SESSION['moderator_id'])) {
            $this->dashboard();
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
        redirect('moderators');
    }

    private function isLoggedIn()
    {
        if (isset($_SESSION['moderator_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function dashboard()
    {
        if (!isset($_SESSION['moderator_id'])) {
            $this->index();
        } else {
            $data = [
                'style' => 'jobseeker/dashboard.css',
                'title' => 'Dashboard',
                'header_title' => 'Dashboard'
            ];

            $this->view('moderator/dashboard', $data);
        }
    }

    public function changepassword()
    {
        if (!isset($_SESSION['moderator_id'])) {
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
                ];

                // Validate Old Password
                $loggedInUser = $this->moderatorModel->getUserById($_SESSION['moderator_id']);
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
                    $moderator_id = $_SESSION['moderator_id'];
                    if ($this->moderatorModel->changePassword($moderator_id, $new_password)) {
                        jsflash('Password Updated', '/moderators/dashboard');
                    } else {
                        jsflash('Password update failed', '/moderators/changepassword');
                    }
                } else {
                    // Load view with errors
                    $this->view('moderator/changepassword', $data);
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
                ];

                // Load view
                $this->view('moderator/changepassword', $data);
            }
        }
    }
    public function disputes($dispute_id = null)
    {
        $disputes = $this->moderatorModel->getAlldisputes();
        $data = [
            'style' => 'moderators/disputes.css',
            'title' => 'Disputes',
            'header_title' => 'Disputes',
            'disputes' => $disputes

        ];
        $this->view('moderator/disputes', $data);
    }

    public function verifications()
    {
        $br_details = $this->moderatorModel->getAllBRDetails();
        $data = [
            'style' => 'moderators/verify_BR.css',
            'title' => 'BR verification',
            'header_title' => 'Change Password',
            'BR_details' => $br_details
        ];
        $this->view('moderator/verify', $data);
    }

    public function approve_verification()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if ($this->isLoggedIn()) {
                // Get application ID from POST data
                $recruiter_id = trim(htmlspecialchars($_POST['recruiter_id']));

                // Perform accept action
                if ($this->moderatorModel->approve_validation($recruiter_id)) {
                    // Return success message
                    $message = 'Recruiter Approved';
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
}
