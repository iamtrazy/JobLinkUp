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
    public function transactions(){
    $br_details = $this->moderatorsModel->getAllBRDetails();
    $data = [
        'style' => 'moderators/verify_BR.css',
        'title' => 'BR verification',
        'header_title' => 'Change Password',
        'BR_details'=>$br_details
    ];


    $this->view('moderator/verify_BR', $data);
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


    public function deleteModerator($moderator_id = null){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            
                if ($this->adminModel->deleteModerator($moderator_id)) {
                    $response = ['status' => 'success', 'message' => 'Job Deleted Successfully'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Failed to delete job'];
                }
            

            $this->view('api/json', $response);
    }

   
}
public function publish_notice(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $data = [
            
            'notice_id' => trim(htmlspecialchars($_POST['notice_id'])),
            'title' => trim(htmlspecialchars($_POST['title'])),
            'description' => trim(htmlspecialchars($_POST['description'])),
            'link' => trim(htmlspecialchars($_POST['link'])),
            'expiry_date' => trim(htmlspecialchars($_POST['expiry_date'])),
            'created_at' => trim(htmlspecialchars($_POST['created_at'])),
            'persmissons'=>'',
            //banner image

            // if (array_key_exists('banner_image', $data)) {
            //     // If 'banner_image' key exists, bind it to the database statement
            //     $this->db->bind(':banner_image', $data['banner_image']);
            // } else {
            //     // If 'banner_image' key does not exist, bind NULL to the database statement
            //     $this->db->bind(':banner_image', "job-detail-bg.jpg");
            // }

            'title_empty'=>'',
            'description_empty'=>'',

            // 'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
        
        ];
        if(empty($data['title'])) {
            $data['title_empty'] = 'please enter a title';

        }
        if(empty($data['description'])) {
            $data['title_empty'] = 'please enter a description';

        }
       

         // Check if banner image is uploaded
      if (isset($_FILES['notice_image'])) {
        $bannerImagePath = $this->upload_media("notice_image", $_FILES, "/img/job_banner/", ['jpg', 'jpeg', 'png'], 1000000);

        // If banner image is uploaded, add it to $data
        if ($bannerImagePath) {
          $data['notice_image'] = $bannerImagePath;
        }
      } else {
        $data['data_err'] = 'Image upload failed (check image extension or size)';
      }
        
            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Pleae confirm password';

             if(!empty($data['title_empty']) || !empty($data['description_empty'])) {
                    echo "<p>Please enter all the details</p>";
                }

        if ($this->adminModel->publishNotice($data)) {
            jsflash('notice published', 'admins/managenotices');
        } else {
            die('Something went wrong');
        }

    }} else {

        $data = [
            'style' => 'recruiter/postjob.css',
            'title' => 'Publish Announcements',
            'header_title' => 'Publsh announcement',
            $notice = $this->adminModel->publishNotice()

            // 'profile_image' => $this->getRecruiterProfileImage($_SESSION['business_id'])
        ];

        $this->view('admin/publish_notice', $data);

    }
      

}
public function manageNotices(){

    $notices = $this->adminModel->getNotices();
    // $deleteNotice = $this->adminModel->deleteNotice($notices);
    $data = [
        'style' => 'recruiter/manage.css',
        'title' => 'Manage Notices',
        'header_title' => 'Manage notices',
        'notices'=>$notices
    ];
    $this->view('admin/manage_notices', $data);

}




  
} 
 