<?php
class Recruiters extends Controller
{

    public $recruiterModel;
    public $jobModel;

    public function __construct()
    {
        $this->recruiterModel = $this->model('Recruiter');
        $this->jobModel = $this->model('Job');
        // $this->applicationsModel = $this->model('Applications');
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

        // if (isset($_SESSION['business_id'])) {
        //     $this->dashboard();
        // } else {
        //     $this->view('recruiters/register', $data);
        // }
        $this->dashboard();
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
        // if (!isset($_SESSION['business_id'])) {
        //     $this->login();
        // } else {
            $data = [
                'style' => 'recruiter/dashboard.css',
                'title' => 'Dashboard',
                'header_title' => 'Dashboard'
            ];

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
    public function profile()
    {
        $data = [
            'style' => 'recruiter/myprofile.css',
            'title' => 'profile',
            'header_title' => 'Chamudi Siriwardhane'
        ];

        $this->view('recruiters/myprofile', $data);
    }
    public function applications()
    {


       

    }
    public function editprofile()
    {
        $data = [
            'style' => 'recruiter/editprofile.css',
            'title' => 'Edit profile',
            'header_title' => 'Edit Profile'
        ];

        $this->view('recruiters/editprofile', $data);
    }
   
        
    // public function applications($id = null, $action = null)
    // {
    //     if (!isset($_SESSION['user_id'])) {
    //         $this->login();
    //     } else {
    //         if ($id == NULL) {
    //             $this->dashboard();
    //         }
    //         if ($action == 'delete') {

    //             $job_id_str = trim(htmlspecialchars($id));
    //             $job_id = (int)$job_id_str;

    //             $data = [
    //                 'style' => 'jobrecruiter/applications.css',
    //                 'title' => 'Job Applications',
    //                 'header_title' => 'Job Applications',
    //                 'job_id' => $job_id,
    //                 'seeker_id' => $_SESSION['user_id']
    //             ];
    //             $this->applicationModel->deleteFromApplications($data);
    //             $this->view('applications/confirm', $data);
    //         }

    //         $applications = $this->applicationModel->getApplication($id);

    //         $data = [
    //             'style' => 'jobseeker/wishlist.css',
    //             'title' => 'Wishlist',
    //             'header_title' => 'Wishlist',
    //             'wishlist' => $wishlist
    //         ];
    //         $this->view('application/index', $data);
    //     }
    // }

    // public function appliedJobs()
    // {
    //     if (!isset($_SESSION['user_id'])) {
    //         $this->login();
    //     } else {
    //         $data = [
    //             'style' => 'jobseeker/applied.css',
    //             'title' => 'Applied Jobs',
    //             'header_title' => 'Applied Jobs',
    //         ];

    //         $this->view('jobseeker/jobs-applied', $data);
    //     }
    // }


    // public function applicationalerts()
    // {
    //     if (!isset($_SESSION['user_id'])) {
    //         $this->login();
    //     } else {
    //         $data = [
    //             'style' => 'jobrecruiter/alerts.css',
    //             'title' => 'Pending applications',
    //             'header_title' => 'Job Alerts',
    //         ];

    //         $this->view('jobseeker/jobalerts', $data);
    //     }
    // }


    // public function changePassword()
    // {
    //     if (!isset($_SESSION['user_id'])) {
    //         $this->login();
    //     } else {
    //         $data = [
    //             'style' => 'jobrecruiter/pass.css',
    //             'title' => 'Change Password',
    //             'header_title' => 'Change Password',
    //         ];

    //         $this->view('jobrecruiter/changepassword', $data);
    //     }
    // }

    // public function chat()
    // {
    //     if (!isset($_SESSION['user_id'])) {
    //         $this->login();
    //     } else {
    //         $data = [
    //             'style' => 'jobrecruiter/chat.css',
    //             'title' => 'Chat',
    //             'header_title' => 'Chat With Seekers',
    //         ];

    //         $this->view('jobrecruiter/chat', $data);
    //     }
    // }



    // public function applications($id=null, $action =NULL)
    //  if($action = NULL){
        
    //     $data = [
    //         'style' => 'recruiter/applications.css',
    //         'title' => 'Candidates',
    //         'header_title' => 'Applications'
    //     ];
    
    //     $this->view('recruiters/applications', $data);
    //  }
   
    // {
    //   $job_id_str = trim(htmlspecialchars($id));
    //   $job_id = (int)$job_id_str;
  
    //   $data = [
    //     'job_id' => $job_id,
    //     'seeker_id' => $_SESSION['user_id'],
    //     'data_err' => '',
    //   ];
  
    //   if ($this->applicationsModel->deleteFromApplications($data['seeker_id'], $data['job_id'])) {
    //     $data['data_err'] = 'Error Occured';
    //     $this->view('job/alert', $data);
    //   } else {
    //   }
    //   if (empty($data['data_err'])) {
    //     if ($this->wishlistModel->addtoList($data)) {
    //       $this->view('job/alert', $data);
    //     } else {
    //       die('Something went wrong');
    //     }
    //   }
    // }

    }

