<?php
class Candidates extends Controller
{

  public $jobseekerModel;
  public $recruiterModel;
  public $candidateModel;

  public function __construct()
  {
    // Load Models
    $this->jobseekerModel = $this->model('Jobseeker');
    $this->recruiterModel = $this->model('Recruiter');
    $this->candidateModel = $this->model('Candidate');
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

}
