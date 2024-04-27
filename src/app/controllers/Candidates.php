<?php
class Candidates extends Controller
{

  public $jobseekerModel;
  public $recruiterModel;
  public $candidateModel;
  public $applicationModel;

  public function __construct()
  {
    // Load Models
    $this->jobseekerModel = $this->model('Jobseeker');
    $this->recruiterModel = $this->model('Recruiter');
    $this->candidateModel = $this->model('Candidate');
    $this->applicationModel = $this->model('Application');
  }

  public function index()
  {
    $data = [
      'style' => 'candidates/explore.css',
      'title' => 'Candidates Grid',
      'header_title' => 'Candidates Grid',
    ];

    $this->view('candidates/index', $data);
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


      if (!empty($profile->address)) {
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
        $acceptedApplicationCount = $this->applicationModel->acceptedApplicationCount($id);
        $data = [
          'style' => 'candidates/profile.css',
          'title' => 'Candidate Details',
          'header_title' => 'Candidate Details',
          'profile' => $profile, // Pass job details to the view
          'acceptedApplicationCount' => $acceptedApplicationCount
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
