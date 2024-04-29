<?php
class Jobs extends Controller
{

  public $jobseekerModel;
  public $jobModel;
  public $wishlistModel;
  public $applicationModel;
  public $adminModel;

  public function __construct()
  {
    // Load Models
    $this->jobModel = $this->model('Job');
    $this->jobseekerModel = $this->model('Jobseeker');
    $this->wishlistModel = $this->model('Wishlist');
    $this->applicationModel = $this->model('Application');
    $this->adminModel = $this->model('Admin');
  }

  private function whichUser()
  {
    if (isset($_SESSION['user_id'])) {
      return 'seeker';
    } elseif (isset($_SESSION['business_id'])) {
      return 'recruiter';
    } elseif (isset($_SESSION['moderator_id'])) {
      return 'moderator';
    } else {
      return 'guest';
    }
  }

  private function setGuest()
  {
    if (!isset($_SESSION['user_id'])) {
      $_SESSION['guest_id'] = '1';
      $_SESSION['user_name'] = 'Guest User';
    }
  }

  private function redirectToSeeker()
  {
    if ($this->whichUser() !== 'seeker') {
      jsflash('Login As a Job seeker for this action', 'jobseekers/login');
      die();
    }
  }

  private function redirectToRecruiter()
  {
    if ($this->whichUser() !== 'recruiter') {
      jsflash('Login As a Recruiter for this action', 'recruiters/login');
      die();
    }
  }

  private function jsonRedirectToSeeker()
  {
    if ($this->whichUser() !== 'seeker') {
      $response['error'] = 'Login As a Job seeker for this action';
      echo json_encode($response);
      exit;
    }
  }

  // Load All job
  public function index()
  {
    $this->setGuest();

    $job_ad = $this->adminModel->jobAd();

    $data = [
      'style' => 'jobs/style.css',
      'title' => 'Jobs Grid',
      'header_title' => 'The Most Exciting Jobs',
      'job_ad' => $job_ad
    ];

    $this->view('job/index', $data);
  }


  public function detail($id = null)
  {
    $this->setGuest();
    // Check if $id is provided and is not null
    if ($id !== null) {
      if (isset($_SESSION['moderator_id'])) {
        $job = $this->jobModel->getJobById($id, 1);
      } else {
        $job = $this->jobModel->getJobById($id);
      }
      // Retrieve job details for the given $id
      $appliedCount = $this->jobModel->appliedCount($id);
      $this->jobModel->increaseViewCount($id);
      // Check if job details are retrieved successfully
      if ($job) {
        // Prepare data to pass to the view
        $data = [
          'style' => 'jobs/detail.css',
          'title' => 'Jobs Details',
          'header_title' => 'The Most Exciting Jobs',
          'job' => $job, // Pass job details to the view
          'appliedCount' => $appliedCount // Pass applied count to the view
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

    $this->redirectToSeeker();

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

  public function apply($id, $confirm = "no")
  {
    $this->redirectToSeeker();

    $job_id_str = trim(htmlspecialchars($id));
    $job_id = (int)$job_id_str;

    $recruiter_id = $this->jobModel->getRecruiterIdByJobId($job_id);

    $data = [
      'job_id' => $job_id,
      'seeker_id' => $_SESSION['user_id'],
      'recruiter_id' => $recruiter_id,
      'data_err' => '',
      'confirmation' => 'no',
    ];

    if ($this->applicationModel->appliedForMoreThanFiveJobs($data['seeker_id'])) {
      $data['data_err'] = 'You have already applied for maximum number of jobs';
      $this->view('job/confirm', $data);
    } else {
      if ($this->applicationModel->isApplied($data['seeker_id'], $data['job_id'])) {
        $data['data_err'] = 'You already applied to this job';
        $this->view('job/confirm', $data);
      } else {
        // Ask for confirmation to apply
        if ($data['confirmation'] === 'no') {
          $data['confirmation'] = $confirm; // Set a flag for confirmation
          $this->view('job/confirm', $data);
        }
        if ($data['confirmation'] === 'yes') {
          if (empty($data['data_err'])) {
            if ($this->applicationModel->addtoList($data)) {
              $this->view('job/confirm', $data);
            } else {
              die('Something went wrong');
            }
          }
        }
      }
    }
  }

  // Add Job
  public function add()
  {
    $this->redirectToRecruiter();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Check if a file is uploaded
      $data = [
        'recruiter_id' => $_SESSION['business_id'],
        'location' => '',
        'topic' => '',
        'website' => '',
        'rate' => '',
        'rate_type' => '',
        'type' => '',
        'detail' => '',
        'keywords' => '',
        'data_err' => '',
      ];

      // Sanitize and validate form data
      $filteredData = array_map('trim', array_map('htmlspecialchars', $_POST));

      // Update $data with sanitized values from $_POST
      $data = array_merge($data, $filteredData);

      // Check if banner image is uploaded
      if (isset($_FILES['banner_image'])) {
        $bannerImagePath = $this->upload_media("banner_image", $_FILES, "/img/job_banner/", ['jpg', 'jpeg', 'png'], 1000000);

        // If banner image is uploaded, add it to $data
        if ($bannerImagePath) {
          $data['banner_image'] = $bannerImagePath;
        }
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

  public function report()
  {
    $this->jsonRedirectToSeeker();
    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $response = []; // Initialize response array

      // Sanitize and validate form data
      $job_id = trim(htmlspecialchars($_POST['job_id'] ?? ''));
      $reason = trim(htmlspecialchars($_POST['reason'] ?? ''));
      $otherReason = trim(htmlspecialchars($_POST['otherReason'] ?? '')); // Retrieve otherReason if provided

      // Check if the job ID is provided
      if (empty($job_id)) {
        $response['error'] = 'Job ID is required';
        echo json_encode($response);
        exit; // Stop further execution
      }

      // Check if the user is logged in
      if (!isset($_SESSION['user_id'])) {
        $response['error'] = 'Please log in to report a job';
        echo json_encode($response);
        exit; // Stop further execution
      }

      // Get the logged-in user's ID (seeker ID)
      $seeker_id = $_SESSION['user_id'];

      // Get the recruiter ID associated with the job ID
      $recruiter_id = $this->jobModel->getRecruiterIdByJobId($job_id);

      // Check if the recruiter ID is retrieved successfully
      if (!$recruiter_id) {
        $response['error'] = 'Invalid job ID';
        echo json_encode($response);
        exit; // Stop further execution
      }

      // Set the reason to otherReason if reason is "other"
      if ($reason === 'other') {
        $reason = $otherReason;
      }

      // Additional validation if necessary
      if (empty($reason)) {
        $response['error'] = 'Please provide a reason for reporting the job';
        echo json_encode($response);
        exit; // Stop further execution
      }

      // Report the job using the Job model's reportJob method
      if ($this->jobModel->reportJob($seeker_id, $job_id, $recruiter_id, $reason)) {
        $response['success'] = 'Job reported successfully';
        echo json_encode($response);
        exit; // Stop further execution
      } else {
        $response['error'] = 'Job already reported';
        echo json_encode($response);
        exit; // Stop further execution
      }
    }
  }
}
