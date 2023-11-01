<?php
class Recruiters extends Controller
{

    public $jobModel;

    public function __construct()
    {
        $this->jobModel = $this->model('Job');
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
}