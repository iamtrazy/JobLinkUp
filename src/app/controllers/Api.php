<?php
class Api extends Controller
{

    public $jobseekerModel;
    public $jobModel;
    public $wishlistModel;
    public $chatModel;

    public function __construct()
    {
        // Load Models
        $this->jobModel = $this->model('Job');
        $this->jobseekerModel = $this->model('Jobseeker');
        $this->wishlistModel = $this->model('Wishlist');
        $this->chatModel = $this->model('Chat');
    }

    // Load All job
    public function jobs($page, $perPage, $sort, $timeCriterion, $selected_categories, $keyword = null, $isLocation = null)
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

        // Extract selected categories from POST request
        $categories = isset($selected_categories) ? explode(",", $selected_categories) : ['all'];

        // Fetch jobs for the current page with selected categories
        if ($sort === "date") {
            $sort_by = "created_at";
        } else if ($sort === "category") {
            $sort_by = "category";
        } else if ($sort === "price") {
            $sort_by = "rate";
        } else {
            $sort_by = "created_at";
        }

        $criterion = isset($timeCriterion) ? $timeCriterion : 'all';

        $jobs = $this->jobModel->getJobs($page_no, $per_page, $sort_by, $criterion, $categories, $keyword, $isLocation);

        // Pass page number, jobs, and per page to the view
        $data = [
            'page_no' => $page_no,
            'jobs' => $jobs,
            'per_page' => $per_page
        ];

        $this->view('api/jobs', $data);
    }

    public function jobsearch($page, $perPage, $sort, $timeCriterion, $selected_categories, $keyword = null, $isLocation = null)
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

        // Extract selected categories from POST request
        $categories = isset($selected_categories) ? explode(",", $selected_categories) : ['all'];

        // Fetch jobs for the current page with selected categories
        if ($sort === "date") {
            $sort_by = "created_at";
        } else if ($sort === "category") {
            $sort_by = "category";
        } else if ($sort === "price") {
            $sort_by = "rate";
        } else {
            $sort_by = "created_at";
        }

        $criterion = isset($timeCriterion) ? $timeCriterion : 'all';

        $jobs = $this->jobModel->getJobs($page_no, $per_page, $sort_by, $criterion, $categories, $keyword, $isLocation);

        // Pass page number, jobs, and per page to the view
        $data = [
            'page_no' => $page_no,
            'jobs' => $jobs,
            'per_page' => $per_page
        ];

        $this->view('api/json', $data);
    }




    public function jobcount($selected_categories, $timeCriterion)
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['guest_id'] = '1';
            $_SESSION['user_name'] = 'Guest User';
        }

        $categories = isset($selected_categories) ? explode(",", $selected_categories) : ['all'];
        $criterion = isset($timeCriterion) ? $timeCriterion : "";

        $totalCount = $this->jobModel->totalJobs($categories, $criterion);

        // Prepare response data
        $data = $totalCount;

        $this->view('api/json', $data);
    }

    public function seeker_profile($id) //change permissions
    {
        // Check if the user is logged in, if not, set as guest
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['guest_id'] = '1';
            $_SESSION['user_name'] = 'Guest User';
        }

        // Load the JobseekerModel

        // Get job seeker details by ID
        $jobseeker = $this->jobseekerModel->getJobseekerById($id);

        // Check if job seeker exists
        if ($jobseeker) {
            // Prepare response data
            $data = [
                'id' => $jobseeker->id,
                'username' => $jobseeker->username,
                'email' => $jobseeker->email,
                'gender' => $jobseeker->gender,
                'created_at' => $jobseeker->created_at,
                'phone_no' => $jobseeker->phone_no,
                'website' => $jobseeker->website,
                'age' => $jobseeker->age,
                'address' => $jobseeker->address,
                'location_rec' => $jobseeker->location_rec,
                'keywords' => $jobseeker->keywords,
                'linkedin_url' => $jobseeker->linkedin_url,
                'whatsapp_url' => $jobseeker->whatsapp_url,
                'is_complete' => $jobseeker->is_complete
            ];

            // Send job seeker details as JSON response
            $this->view('api/json', $data);
        } else {
            // Job seeker not found, return error response
            $data = ['error' => 'Job seeker not found'];
            $this->view('api/json', $data);
        }
    }

    public function chat_threads()
    {

        // Check if the user is logged in, if not, set as guest
        if (!isset($_SESSION['user_id']) && !isset($_SESSION['business_id'])) {
            $data = ['error' => 'No chat threads found for the job seeker'];
            $this->view('api/json', $data);;
        } else if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            // Load the Chat model
            // Assuming $this->chatModel was initialized in the constructor

            // Get chat threads associated with the job seeker by ID
            $threads = $this->chatModel->seekerGetRecruiters($id);

            if ($threads) {
                // Format the threads data as needed
                $formatted_threads = [];

                foreach ($threads as $thread) {
                    $formatted_threads[] = [
                        'thread_id' => $thread->id,
                        'recruiter_name' => $thread->name,
                        'business_name' => $thread->business_name,
                        'created_at' => $thread->created_at
                    ];
                }

                // Prepare response data
                $data = $formatted_threads;

                // Send chat threads data as JSON response
                $this->view('api/json', $data);
            } else {
                // No chat threads found for the job seeker, return error response
                $data = ['error' => 'No chat threads found for the job seeker'];
                $this->view('api/json', $data);
            }
        } else if (isset($_SESSION['business_id'])) {
            $id = $_SESSION['business_id'];
            // Load the Chat model
            // Assuming $this->chatModel was initialized in the constructor

            // Get chat threads associated with the recruiter by ID
            $threads = $this->chatModel->recruiterGetSeekers($id);

            if ($threads) {
                // Format the threads data as needed
                $formatted_threads = [];

                foreach ($threads as $thread) {
                    $formatted_threads[] = [
                        'thread_id' => $thread->id,
                        'seeker_name' => $thread->username,
                        'created_at' => $thread->created_at
                    ];
                }

                // Prepare response data
                $data = $formatted_threads;

                // Send chat threads data as JSON response
                $this->view('api/json', $data);
            } else {
                // No chat threads found for the recruiter, return error response
                $data = ['error' => 'No chat threads found for the recruiter'];
                $this->view('api/json', $data);
            }
        }
    }

    public function chat_thread_messages($thread_id)
    {
        // Check if the user is logged in as a job seeker or recruiter
        if (!isset($_SESSION['user_id']) && !isset($_SESSION['business_id'])) {
            $data = ['error' => 'Unauthorized'];
            $this->view('api/json', $data);
        } else if (isset($_SESSION['user_id'])) {
            // Get the current user's ID
            $user_id = $_SESSION['user_id'];

            // Load the Chat model
            // Assuming $this->chatModel was initialized in the constructor

            // Check if the thread belongs to the current user
            if ($this->chatModel->isThreadBelongsToUser($thread_id, $user_id)) {
                // Get chat messages for the specified thread ID
                $messages = $this->chatModel->getChatMessages($thread_id);

                if ($messages) {
                    // Prepare response data
                    $data = $messages;

                    // Send chat messages data as JSON response
                    $this->view('api/json', $data);
                } else {
                    // No chat messages found for the thread, return error response
                    $data = ['error' => 'No chat messages found for the thread'];
                    $this->view('api/json', $data);
                }
            } else {
                // Thread does not belong to the current user, return error response
                $data = ['error' => 'Unauthorized access to chat thread'];
                $this->view('api/json', $data);
            }
        } else if (isset($_SESSION['business_id'])) {
            // Get the current user's ID
            $user_id = $_SESSION['business_id'];

            // Load the Chat model
            // Assuming $this->chatModel was initialized in the constructor

            // Check if the thread belongs to the current user
            if ($this->chatModel->isThreadBelongsToRecruiter($thread_id, $user_id)) {
                // Get chat messages for the specified thread ID
                $messages = $this->chatModel->getChatMessages($thread_id);

                if ($messages) {
                    // Prepare response data
                    $data = $messages;
                    // Send chat messages data as JSON response
                    $this->view('api/json', $data);
                } else {
                    // No chat messages found for the thread, return error response
                    $data = ['error' => 'No chat messages found for the thread'];
                    $this->view('api/json', $data);
                }
            } else {
                // Thread does not belong to the current user, return error response
                $data = ['error' => 'Unauthorized access to chat thread'];
                $this->view('api/json', $data);
            }
        }
    }

    public function chat_send_message($thread_id)
    {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id']) && !isset($_SESSION['business_id'])) {
            $data = ['error' => 'Unauthorized'];
            $this->view('api/json', $data);
        } else if (isset($_SESSION['user_id'])) {
            // Get the current user's ID
            $user_id = $_SESSION['user_id'];

            // Load the Chat model
            // Assuming $this->chatModel was initialized in the constructor

            // Check if the thread belongs to the current user
            if ($this->chatModel->isThreadBelongsToUser($thread_id, $user_id)) {
                // Get the message text from the POST request
                $text = $_POST['text'];

                // Insert the message into the chat_texts table
                $this->chatModel->insertMessage($thread_id, $text, 0);

                // Prepare success response
                $data = ['message' => 'Message sent successfully'];

                // Send success response as JSON
                $this->view('api/json', $data);
            } else {
                // Thread does not belong to the current user, return error response
                $data = ['error' => 'Unauthorized access to chat thread'];
                $this->view('api/json', $data);
            }
        } else if (isset($_SESSION['business_id'])) {
            // Get the current user's ID
            $user_id = $_SESSION['business_id'];

            // Load the Chat model
            // Assuming $this->chatModel was initialized in the constructor

            // Check if the thread belongs to the current user
            if ($this->chatModel->isThreadBelongsToRecruiter($thread_id, $user_id)) {
                // Get the message text from the POST request
                $text = $_POST['text'];

                // Insert the message into the chat_texts table
                $this->chatModel->insertMessage($thread_id, $text, 1);

                // Prepare success response
                $data = ['message' => 'Message sent successfully'];

                // Send success response as JSON
                $this->view('api/json', $data);
            } else {
                // Thread does not belong to the current user, return error response
                $data = ['error' => 'Unauthorized access to chat thread'];
                $this->view('api/json', $data);
            }
        }
    }
}
