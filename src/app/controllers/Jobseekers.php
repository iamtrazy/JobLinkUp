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

   

    public function wishlist($id = null, $action = null)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {
            if ($id == NULL) {
                $this->dashboard();
            }
            if ($action == 'delete') {

                $job_id_str = trim(htmlspecialchars($id));
                $job_id = (int)$job_id_str;

                $data = [
                    'style' => 'jobseeker/wishlist.css',
                    'title' => 'Wishlist',
                    'header_title' => 'Wishlist',
                    'job_id' => $job_id,
                    'seeker_id' => $_SESSION['user_id']
                ];
                $this->wishlistModel->deleteFromList($data);
                $this->view('wishlist/confirm', $data);
            }

            $wishlist = $this->jobModel->getWishlist($id);

            $data = [
                'style' => 'jobseeker/wishlist.css',
                'title' => 'Wishlist',
                'header_title' => 'Wishlist',
                'wishlist' => $wishlist
            ];
            $this->view('wishlist/index', $data);
        }
    }

    public function appliedJobs()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {
            $data = [
                'style' => 'jobseeker/applied.css',
                'title' => 'Applied Jobs',
                'header_title' => 'Applied Jobs',
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
            ];

            $this->view('jobseeker/jobalerts', $data);
        }
    }


    public function changepassword()
    {
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
                    'profile_image' => $this->getJobseekerProfileImage($_SESSION['business_id'])
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
                        jsflash('Password Updated', '/jobseekers/dashboard');
                    } else {
                        jsflash('Password update failed', '/jobseekers/changepassword');
                    }
                } else {
                    // Load view with errors
                    $this->view('jobseekers/changepassword', $data);
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
        if (!isset($_SESSION['user_id'])) {
            $this->login();
        } else {
            $data = [
                'style' => 'jobseeker/chat.css',
                'title' => 'Chat',
                'header_title' => 'Chat With Recruiters',
            ];

            $this->view('jobseeker/chat', $data);
        }
    }


    public function profile($id = null)
    {
      if (!isset($_SESSION['user_id'])) {
        $_SESSION['guest_id'] = '1';
        $_SESSION['user_name'] = 'Guest User';
      }
  
      // Check if $id is provided and is not null
      if ($id !== null) {
        // Retrieve job details for the given $id
        $profile = $this->candidateModel->getCandidateById($id);
  
  
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
            'title' => 'Candidate Details',
            'header_title' => 'Candidate Details',
            'profile' => $profile // Pass job details to the view
          ];
  
          // Load the detail view with job details
          $this->view('candidates/profile', $data);
        } else {
          // Handle case when job details are not found
          // You can display an error message or redirect to a different page
          jsflash('Candidate not found', 'jobs');
        }
      } else {
        // Handle case when $id is not provided or is null
        // You can display an error message or redirect to a different page
        jsflash('Candidate not found', 'jobs');
      }
    }
   
}
