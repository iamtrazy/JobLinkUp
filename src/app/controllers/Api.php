<?php
class Api extends Controller
{

    public $jobseekerModel;
    public $jobModel;
    public $wishlistModel;
    public $chatModel;
    public $recruiterModel;
    public $candidateModel;

    public function __construct()
    {
        // Load Models
        $this->jobModel = $this->model('Job');
        $this->jobseekerModel = $this->model('Jobseeker');
        $this->wishlistModel = $this->model('Wishlist');
        $this->chatModel = $this->model('Chat');
        $this->recruiterModel = $this->model('Recruiter');
        $this->candidateModel = $this->model('Candidate');
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

        // Count the number of jobs
        $job_count = count($jobs);

        // Pass page number, jobs, and per page to the view along with job count
        $data = [
            'page_no' => $page_no,
            'jobs' => $jobs,
            'per_page' => $per_page,
            'job_count' => $job_count
        ];

        $this->view('api/json', $data);
    }


    public function candidates($page, $perPage, $sort, $keyword = null, $isLocation = null)
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

        // Fetch candidates for the current page
        if ($sort === "date_joined") {
            $sortBy = "date_joined";
        } else {
            $sortBy = "profile_completion"; // Default sorting by created_at
        }

        // Call the recruiterModel's getCandidates method to fetch candidates
        $candidates = $this->candidateModel->getCandidates($page_no, $per_page, $sortBy, $keyword, $isLocation);


        foreach ($candidates as &$seeker) {

            if ((!empty($seeker->address))) {
                $locationData = gelocate($seeker->address);
                if ($locationData === null) {
                    $seeker->country = 'unknown';
                    $seeker->city = 'unknown';
                    continue;
                }
                $seeker->country = $locationData['country'];
                $seeker->city = $locationData['city'];
            } else {
                $seeker->country = 'unknown';
                $seeker->city = 'unknown';
            }
        }

        // Pass page number, candidates, and per page to the view
        $data = [
            'page_no' => $page_no,
            'candidates' => $candidates,
            'per_page' => $per_page
        ];

        $this->view('api/candidates', $data);
    }

    public function candidates_search($page, $perPage, $sort, $keyword = null, $isLocation = null)
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

        // Fetch candidates for the current page
        if ($sort === "date_joined") {
            $sortBy = "date_joined";
        } else {
            $sortBy = "profile_completion"; // Default sorting by created_at
        }

        // Call the recruiterModel's getCandidates method to fetch candidates
        $candidates = $this->candidateModel->getCandidates($page_no, $per_page, $sortBy, $keyword, $isLocation);
        $candidate_count = count($candidates);

        foreach ($candidates as &$seeker) {

            if (($seeker->address) !== null) {
                $locationData = gelocate($seeker->address);
                if ($locationData === null) {
                    $seeker->country = 'unknown';
                    $seeker->city = 'unknown';
                    continue;
                }
                $seeker->country = $locationData['country'];
                $seeker->city = $locationData['city'];
            } else {
                $seeker->country = 'unknown';
                $seeker->city = 'unknown';
            }
        }

        // Pass page number, candidates, and per page to the view
        $data = [
            'page_no' => $page_no,
            'candidates' => $candidates,
            'per_page' => $per_page,
            'candidate_count' => $candidate_count
        ];

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
                'about' => $jobseeker->about,
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

    public function recruiter_profile($id) //change permissions
    {
        // Check if the user is logged in, if not, set as guest
        if (!isset($_SESSION['business_id'])) {
            $_SESSION['guest_id'] = '1';
            $_SESSION['user_name'] = 'Guest User';
        }

        // Load the RecruiterModel

        // Get recruiter details by ID
        $recruiter = $this->recruiterModel->getRecruiterById($id);

        // Check if recruiter exists
        if ($recruiter) {
            // Prepare response data
            $data = [
                'id' => $recruiter->id,
                'name' => $recruiter->name,
                'email' => $recruiter->email,
                'phone_no' => $recruiter->phone_no,
                'age' => $recruiter->age,
                'address' => $recruiter->address,
                'about' => $recruiter->about,
                'linkedin_url' => $recruiter->linkedin_url,
                'whatsapp_url' => $recruiter->whatsapp_url
            ];

            // Send recruiter details as JSON response
            $this->view('api/json', $data);
        } else {
            // Recruiter not found, return error response
            $data = ['error' => 'Recruiter not found'];
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
                        'created_at' => $thread->created_at,
                        'profile_image' => $thread->profile_image
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
                        'created_at' => $thread->created_at,
                        'profile_image' => $thread->profile_image
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

                    foreach ($messages as $message) {
                        $inverted_message = $message; // Create a copy of the original message
                        if ($message['reply']) {
                            $inverted_message['reply'] = false;
                        } else {
                            $inverted_message['reply'] = true;
                        }
                        // Append the modified message to the new array
                        $messages_invert[] = $inverted_message;
                    }

                    //data variable should be created using the modified messages array in the above foreach loop
                    $data = $messages_invert;

                    // $data = $messages;
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
