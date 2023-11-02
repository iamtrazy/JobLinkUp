<?php
class Jobs extends Controller
{

    public $jobseekerModel;
    public $jobModel;
    public $wishlistModel;

    public function __construct()
    {
        // Load Models
        $this->jobModel = $this->model('Job');
        $this->jobseekerModel = $this->model('Jobseeker');
        $this->wishlistModel = $this->model('Wishlist');
    }

    // Load All job
    public function index()
    {
      if(!isset($_SESSION['user_id'])){
        $_SESSION['guest_id'] = '1';
        $_SESSION['user_name'] = 'Guest User';
      }
        $jobs = $this->jobModel->getJobs();

        $data = [
            'style' => 'jobs/style.css',
            'title' => 'Jobs Grid',
            'header_title' => 'The Most Exciting Jobs',
            'jobs' => $jobs
        ];

        $this->view('job/index', $data);
    }

    public function wishlist($id)
    {
        $job_id_str = trim(htmlspecialchars($id));
        $job_id = (int)$job_id_str;

        $data = [
            'job_id' => $job_id,
            'seeker_id' => $_SESSION['user_id'],
            'data_err' => '',
        ];

        if ($this->wishlistModel->findWishlist($data['seeker_id'], $data['job_id'])) {
            $data['data_err'] = 'Item is already in the wishlist';
            $this->view('job/alert', $data);
        } else {
        }
        if (empty($data['data_err'])) {
            if ($this->wishlistModel->addtoList($data)) {
                $this->view('job/alert', $data);
            } else {
                die('Something went wrong');
            }
        }
    }

    // Add Post
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $data = [
            'location' => trim(htmlspecialchars($_POST['location'])),
            'topic' => trim(htmlspecialchars($_POST['topic'])),
            'website' => trim(htmlspecialchars($_POST['website'])),
            'rate' => trim(htmlspecialchars($_POST['rate'])),
            'type' => trim(htmlspecialchars($_POST['type'])),
            'detail' => trim(htmlspecialchars($_POST['detail'])),
            'category' => trim(htmlspecialchars($_POST['category'])), 
            'data_err' => '',
            'data_err' => ''
          ];
  
           if(empty($data['location'])){
            $data['title_err'] = 'Please enter location';
            // Validate name
            if(empty($data['topic'])){
              $data['rate'] = 'Please enter rate';
            }
          }
  
          // Make sure there are no errors
          if(empty($data['title_err']) && empty($data['body_err'])){
            // Validation passed
            //Execute
            if($this->jobModel->addJob($data)){
              // Redirect to login
              $this->view('job/add_alert', $data);
            } else {
              die('Something went wrong');
            }
          } else {
            // Load view with errors
            $this->view('recruiters/postjob', $data);
          }
  
        } else {
          $data = [
            'title' => '',
            'body' => '',
          ];
  
          $this->view('posts/add', $data);
        }
      }
}
