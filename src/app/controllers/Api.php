<?php
class Api extends Controller
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
    public function jobs($page, $perPage, $sort)
    {
        // Sanitize and validate page number
        $page_no = filter_var($page, FILTER_VALIDATE_INT);
        if ($page_no === false || $page_no <= 0) {
            $page_no = 1;
        }

        // Sanitize and validate records per page
        $per_page = filter_var($perPage, FILTER_VALIDATE_INT);
        if ($per_page === false || $per_page <= 0) {
            $per_page = 10; // Default to 10 records per page if invalid value provided
        }

        // Fetch jobs for the current page
        if ($sort === "date") {
            $sort_by = "created_at";
        } else if ($sort === "category") {
            $sort_by = "category";
        } else if ($sort === "price") {
            $sort_by = "rate";
        } else {
            $sort_by = "created_at";
        }

        $jobs = $this->jobModel->getJobs($page_no, $per_page, $sort_by);

        // Pass page number, jobs, and per page to the view
        $data = [
            'page_no' => $page_no,
            'jobs' => $jobs,
            'per_page' => $per_page
        ];

        $this->view('api/jobs', $data);
    }


    public function jobcount()
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['guest_id'] = '1';
            $_SESSION['user_name'] = 'Guest User';
        }

        $totalCount = $this->jobModel->totalJobs();

        // Prepare response data
        $data = $totalCount;

        $this->view('api/json', $data);
    }
}
