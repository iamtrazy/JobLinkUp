<?php
class Jobs extends Controller
{

  public $jobseekerModel;
  public $jobModel;
  public $wishlistModel;
  public $applicationModel;

  public function __construct()
  {
    // Load Models
    $this->jobModel = $this->model('Job');
    $this->jobseekerModel = $this->model('Jobseeker');
    $this->wishlistModel = $this->model('Wishlist');
    $this->applicationModel = $this->model('applications');
  }

  // Load All job
  public function index()
  {
    if (!isset($_SESSION['user_id'])) {
      $_SESSION['guest_id'] = '1';
      $_SESSION['user_name'] = 'Guest User';
    }

    $data = [
      'style' => 'jobs/style.css',
      'title' => 'Jobs Grid',
      'header_title' => 'The Most Exciting Jobs',
    ];

    $this->view('job/index', $data);
  }


  public function detail($id = null)
  {
    if (!isset($_SESSION['user_id'])) {
      $_SESSION['guest_id'] = '1';
      $_SESSION['user_name'] = 'Guest User';
    }

    // Check if $id is provided and is not null
    if ($id !== null) {
      // Retrieve job details for the given $id
      $job = $this->jobModel->getJobById($id);

      // Check if job details are retrieved successfully
      if ($job) {
        // Prepare data to pass to the view
        $data = [
          'style' => 'jobs/detail.css',
          'title' => 'Jobs Details',
          'header_title' => 'The Most Exciting Jobs',
          'job' => $job // Pass job details to the view
        ];

        // Load the detail view with job details
        $this->view('job/detail', $data);
      } else {
        // Handle case when job details are not found
        // You can display an error message or redirect to a different page
        jsflash('Job details not found', 'jobs');
        die('Job details not found');
      }
    } else {
      // Handle case when $id is not provided or is null
      // You can display an error message or redirect to a different page
      jsflash('Job details not found', 'jobs');
      die('Job ID is required');
    }
  }

  // public function detail($id = null)
  // {
  //   if (!isset($_SESSION['user_id'])) {
  //     $_SESSION['guest_id'] = '1';
  //     $_SESSION['user_name'] = 'Guest User';
  //   }

  //   $data = [
  //     'style' => 'jobs/detail.css',
  //     'title' => 'Jobs Details',
  //     'header_title' => 'The Most Exciting Jobs',
  //   ];

  //   $this->view('job/detail', $data);
  // }

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

  public function apply($id)
  {
    $job_id_str = trim(htmlspecialchars($id));
    $job_id = (int)$job_id_str;

    $data = [
      'job_id' => $job_id,
      'seeker_id' => $_SESSION['user_id'],
      'data_err' => '',
    ];

    if ($this->applicationModel->isApplied($data['seeker_id'], $data['job_id'])) {
      $data['data_err'] = 'You already applied to this job';
      $this->view('job/alert', $data);
    } else {
    }
    if (empty($data['data_err'])) {
      if ($this->applicationModel->addtoList($data)) {
        $this->view('job/alert', $data);
      } else {
        die('Something went wrong');
      }
    }
  }

  // Add Job
  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Check if a file is uploaded
      $bannerImagePath = $this->upload_media("banner_image", $_FILES, "/img/job_banner/");
      // Sanitize and validate other form data
      $data = [
        'recruiter_id' => $_SESSION['business_id'],
        'location' => trim(htmlspecialchars($_POST['location'])),
        'topic' => trim(htmlspecialchars($_POST['topic'])),
        'website' => trim(htmlspecialchars($_POST['website'])),
        'rate' => trim(htmlspecialchars($_POST['rate'])),
        'rate_type' => trim(htmlspecialchars($_POST['rate_type'])),
        'type' => trim(htmlspecialchars($_POST['type'])),
        'detail' => trim(htmlspecialchars($_POST['detail'])),
        'keywords' => trim(htmlspecialchars($_POST['keywords'])),
        'data_err' => '',
      ];

      if (isset($bannerImagePath)) {
        $data = [
          'recruiter_id' => $_SESSION['business_id'],
          'location' => trim(htmlspecialchars($_POST['location'])),
          'topic' => trim(htmlspecialchars($_POST['topic'])),
          'website' => trim(htmlspecialchars($_POST['website'])),
          'rate' => trim(htmlspecialchars($_POST['rate'])),
          'rate_type' => trim(htmlspecialchars($_POST['rate_type'])),
          'type' => trim(htmlspecialchars($_POST['type'])),
          'detail' => trim(htmlspecialchars($_POST['detail'])),
          'keywords' => trim(htmlspecialchars($_POST['keywords'])),
          'data_err' => '',
          'banner_image' => $bannerImagePath
        ];
      } else {
        $data['data_err'] = 'Image upload failed (check image extension or size)';
      }
      // Validate form data
      if (empty($data['rate'])) {
        $data['data_err'] = 'Please enter rate';
      }
      if (empty($data['location']) || empty($data['topic']) || empty($data['type']) || empty($data['detail'])) {
        $data['data_err'] = 'Please enter all details';
      }

      // Make sure there are no errors
      if (empty($data['data_err'])) {
        // Validation passed
        //Execute
        if ($this->jobModel->addJob($data)) {
          jsflash('Job published', 'recruiters/postjob');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        jsflash($data['data_err'], 'recruiters/postjob');
      }
    }
  }
}
