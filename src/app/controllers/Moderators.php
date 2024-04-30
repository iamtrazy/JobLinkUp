<?php
class Moderators extends Controller
{

    public $moderatorModel;
    public $recruiterModel;

    public function __construct()
    {
        $this->moderatorModel = $this->model('Moderator');
        $this->recruiterModel = $this->model('Recruiter');
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


    private function onlyModerator()
    {
        if ($this->whichUser() != 'moderator') {
            redirect('moderators/login');
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
                    $mod = $this->moderatorModel->getUserByEmail($data['login_email']);
                    if ($mod->is_disabled == 1) {
                        $data['login_email_err'] = 'User disabled';
                    }
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
                    'style' => 'moderators/login.css',
                    'title' => 'Moderator Login',
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
        $this->onlyModerator();

        $count_applications = $this->moderatorModel->countBRDetails()->application_count;
        $count_pending_payments = $this->moderatorModel->countPendingPayments()->pending_payments;
        $count_disputes = $this->moderatorModel->countDisputes()->disputes_count;
        $count_verified_recruiters = $this->moderatorModel->countVerifiedRecruiters()->verified_recruiters;

        if (!isset($_SESSION['moderator_id'])) {
            $this->index();
        } else {
            $data = [
                'style' => 'jobseeker/dashboard.css',
                'title' => 'Dashboard',
                'header_title' => 'Dashboard',
                'application_count' => $count_applications,
                'pending_payments' => $count_pending_payments,
                'disputes_count' => $count_disputes,
                'verified_recruiters' => $count_verified_recruiters
            ];

            $this->view('moderator/dashboard', $data);
        }
    }

    public function changepassword()
    {
        $this->onlyModerator();
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
        $this->onlyModerator();
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
        $this->onlyModerator();
        $br_details = $this->moderatorModel->getAllBRDetails();
        $data = [
            'style' => 'moderators/verify_BR.css',
            'title' => 'BR verification',
            'header_title' => 'Change Password',
            'BR_details' => $br_details
        ];
        $this->view('moderator/verify', $data);
    }

    public function transactions()
    {
        $this->onlyModerator();
        $transactions = $this->moderatorModel->getAllTransactions();
        $data = [
            'style' => 'moderators/transactions.css',
            'title' => 'Transactions',
            'header_title' => 'Transactions',
            'transactions' => $transactions
        ];
        $this->view('moderator/transactions', $data);
    }

    public function approve_verification()
    {
        $this->onlyModerator();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if ($this->isLoggedIn()) {
                // Get application ID from POST data
                $recruiter_id = trim(htmlspecialchars($_POST['recruiter_id']));

                // Perform accept action
                if ($this->moderatorModel->approve_validation($recruiter_id)) {
                    $recruiter = $this->recruiterModel->getRecruiterById($recruiter_id);
                    $email_body = "Your Business Registration has been approved by the moderator. You can now post Varified Jobs on our platform";
                    send_email($recruiter->email, $recruiter->name, "Business Registration Approved", $email_body);
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

    public function disable_recruiter()
    {
        $this->onlyModerator();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if ($this->isLoggedIn()) {
                // Get application ID from POST data
                $recruiter_id = trim(htmlspecialchars($_POST['recruiter_id']));

                // Perform disable action
                if ($this->moderatorModel->disablerecruiter($recruiter_id)) {
                    // Return success message
                    $response = [
                        'status' => 'success',
                        'message' => 'Recruiter Disabled'
                    ];
                } else {
                    // Return error message
                    $response = [
                        'status' => 'error',
                        'message' => 'Failed to disable recruiter'
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

    public function enable_recruiter()
    {
        $this->onlyModerator();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if ($this->isLoggedIn()) {
                // Get application ID from POST data
                $recruiter_id = trim(htmlspecialchars($_POST['recruiter_id']));

                // Perform enable action
                if ($this->moderatorModel->enablerecruiter($recruiter_id)) {
                    // Return success message
                    $response = [
                        'status' => 'success',
                        'message' => 'Recruiter Enabled'
                    ];
                } else {
                    // Return error message
                    $response = [
                        'status' => 'error',
                        'message' => 'Failed to enable recruiter'
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

    public function disable_job()
    {
        $this->onlyModerator();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if ($this->isLoggedIn()) {
                // Get application ID from POST data
                $job_id = trim(htmlspecialchars($_POST['job_id']));

                // Perform disable action
                if ($this->moderatorModel->disableJob($job_id)) {
                    // Return success message
                    $response = [
                        'status' => 'success',
                        'message' => 'Job Disabled'
                    ];
                } else {
                    // Return error message
                    $response = [
                        'status' => 'error',
                        'message' => 'Failed to disable job'
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


    public function enable_job()
    {
        $this->onlyModerator();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if ($this->isLoggedIn()) {
                // Get application ID from POST data
                $job_id = trim(htmlspecialchars($_POST['job_id']));

                // Perform enable action
                if ($this->moderatorModel->enableJob($job_id)) {
                    // Return success message
                    $response = [
                        'status' => 'success',
                        'message' => 'Job Enabled'
                    ];
                } else {
                    // Return error message
                    $response = [
                        'status' => 'error',
                        'message' => 'Failed to enable job'
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

    public function report_job_admin()
    {
        $this->onlyModerator();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if ($this->isLoggedIn()) {
                // Get application ID from POST data
                $job_id = trim(htmlspecialchars($_POST['job_id']));
                $mod_id = $_SESSION['moderator_id'];

                if ($this->moderatorModel->jobAlreadyReported($job_id, $mod_id)) {
                    // Return error message
                    $response = [
                        'status' => 'error',
                        'message' => 'Job already reported'
                    ];
                } else {
                    // Perform report action
                    if ($this->moderatorModel->reportJobAdmin($job_id, $mod_id)) {
                        // Return success message
                        $admin_email = $this->moderatorModel->getAdminEmail()->email;
                        $email_body = 'A job has been reported by a moderator. Please review the job and take necessary action' . '<a href="' . URLROOT . '/jobs/details/' . $job_id . '"> View Job</a>';
                        send_email($admin_email, 'Admin', 'Job Reported', $email_body);
                        $response = [
                            'status' => 'success',
                            'message' => 'Job Reported'
                        ];
                    } else {
                        // Return error message
                        $response = [
                            'status' => 'error',
                            'message' => 'Failed to report job'
                        ];
                    }
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
        $this->view('api/json', $response);
    }

    public function report_recruiter_admin()
    {
        $this->onlyModerator();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if user is logged in
            if ($this->isLoggedIn()) {
                // Get application ID from POST data
                $recruiter_id = trim(htmlspecialchars($_POST['recruiter_id']));
                $mod_id = $_SESSION['moderator_id'];

                if ($this->moderatorModel->recruiterAlreadyReported($recruiter_id, $mod_id)) {
                    // Return error message
                    $response = [
                        'status' => 'error',
                        'message' => 'Recruiter already reported'
                    ];
                } else {
                    // Perform report action
                    if ($this->moderatorModel->reportRecruiterAdmin($recruiter_id, $mod_id)) {
                        // Return success message
                        $admin_email = $this->moderatorModel->getAdminEmail()->email;
                        $email_body = 'A Recruiter has been reported by a moderator. Please review and take necessary action' . '<a href="' . URLROOT . '/recruiters/public_profile/' . $recruiter_id . '"> View Recruiter</a>';
                        send_email($admin_email, 'Admin', 'Recruiter Reported', $email_body);
                        $response = [
                            'status' => 'success',
                            'message' => 'Recruiter Reported'
                        ];
                    } else {
                        // Return error message
                        $response = [
                            'status' => 'error',
                            'message' => 'Failed to report recruiter'
                        ];
                    }
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
        $this->view('api/json', $response);
    }
}
