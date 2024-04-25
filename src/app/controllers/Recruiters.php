<?php
class Recruiters extends Controller
{

    public $recruiterModel;
    public $jobModel;
    public $applicationModel;

    public function __construct()
    {
        $this->recruiterModel = $this->model('Recruiter');
        $this->jobModel = $this->model('Job');
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
        //applyForBR
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

    public function explore()
    {
        $all_seekers = $this->recruiterModel->getAll();
        $data = [
            'style' => 'recruiter/explore.css',
            'title' => 'Recruiters Grid',
            'header_title' => 'Explore',
            'all_seekers' => $all_seekers

        ];
        $this->view('recruiters/explore', $data);
    }


    public function applyForBR(){
        if ($_SERVER['REQUEST_METHOD']== 'POST'){
            $data = [
                'application_id'=> trim(htmlspecialchars($_POST['application_id'])),
                'recruiter_id'=> $_SESSION['business_id'],
                'website'=> trim(htmlspecialchars($_POST['website'])),
                'business_email'=> trim(htmlspecialchars($_POST['business_email'])),
                'business_contact_no'=> trim(htmlspecialchars($_POST['business_contact_no'])),
                'business_name'=> trim(htmlspecialchars($_POST['business_name'])),
                'business_type'=> trim(htmlspecialchars($_POST['business_type'])),
                'business_reg_no'=> trim(htmlspecialchars($_POST['business_reg_no'])),
                'business_address'=> trim(htmlspecialchars($_POST['business_address'])),
                'contact_person'=> trim(htmlspecialchars($_POST['contact_person'])),
                'contact_email'=> trim(htmlspecialchars($_POST['contact_email'])),
                'contact_number'=> trim(htmlspecialchars($_POST['contact_number'])),
                'agree_to_terms'=> trim(htmlspecialchars($_POST['agree_to_terms'])),
                'empty_err'=>'',
                'contact_number_err'=>'',
                'business_reg_no_err' => '',
                'agree_to_terms_err'=> '',
            ];

                //validate business email and contact email
                if(empty($data['business_email']) || empty($data['contact_email']) || empty($data['business_name']) || empty($data['business_type'])){
                    $data['empty_err'] = 'this is a required field';
                }

                //validate business_contact_no and contact person's number
                if (strlen($data['business_contact_no']) != 10 || strlen($data['contact_number']) != 10) {
                            $data['contact_number_err'] = 'invalid number format';
                }


                
                //validate business_reg_no
                if(strlen($data['business_reg_no']) != 10){
                        $data['business_reg_no_err'] = 'this is not a valid business registration numeber';
                }

                //validate business _address
                //validate contact-person
                //validate contact_email
                //validate contact_number

                //validate agree_to_terms
                if ($data['agree_to_terms'] == false) {
                    $data['agree_to_terms_err'] = "Please agree to the terms and conditions.";
                } else {
                    // Checkbox is checked
                    // Proceed with other form processing
                }

                    //make sure errors are empty
                    if(empty($data['empty_err'] && empty($data['contact_number_err']) && empty($data['agree_to_terms_err'])) && empty($data['business_reg_no_err'])){
                        //validate
                        if($this->recruiterModel->applyForBR($data)){
                            flash('register_success','please choose a payment method');
                            redirect('recruiters/payment');

                        }else{
                            die('you changes couldnt be saved');
                        }
                    }
                    else{
                        //load view with errors
                        $this->view('recruiters/applyForBR',$data);
                    }
                   
        }
        //if the request methid is not post
        else{
        $data = [
        'application_id'=> 
                'recruiter_id'=> '',
                'website'=>'',
                'business_email'=> '',
                'business_contact_no'=> '',
                'business_name'=>'',
                'business_type'=> '',
                'business_reg_no'=> '',
                'business_address'=> '',
                'contact_person'=>'',
                'contact_email'=> '',
                'contact_number'=> '',
                'agree_to_terms'=> '',
                'empty_err'=>'',
                'contact_number_err'=>'',
                'business_reg_no_err' => '',
                'agree_to_terms_err'=> '',
        ];
        //load view
        $this->view('recruiters/applyForBr',$data);
    }

    }
}
