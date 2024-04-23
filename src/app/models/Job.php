<?php
class Job
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function totalJobs($selectedCategories, $timeCriterion)
    {
        // Check if selectedCategories is provided and not empty
        if (!($selectedCategories[0] == 'all')) {
            // Construct the WHERE clause for types
            $typesCondition = "WHERE type IN ('" . implode("', '", $selectedCategories) . "')";
        } else {
            $typesCondition = "WHERE 1"; // If no types are provided, leave the condition empty
        }

        // Construct the time criterion condition
        switch ($timeCriterion) {
            case "1":
                $timeCondition = "AND created_at >= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
                break;
            case "24":
                $timeCondition = "AND created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)";
                break;
            case "7":
                $timeCondition = "AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
                break;
            case "14":
                $timeCondition = "AND created_at >= DATE_SUB(NOW(), INTERVAL 14 DAY)";
                break;
            case "30":
                $timeCondition = "AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
                break;
            default:
                $timeCondition = ""; // For "all" or unknown values, leave the condition empty
                break;
        }

        // Construct the SQL query with the types condition and time criterion
        $query = "SELECT COUNT(*) AS total_jobs FROM jobs $typesCondition $timeCondition";
        $this->db->query($query);
        $row = $this->db->single();
        return $row;
    }

    public function getJobs($page, $perPage, $sort_by, $timeCriterion, $selectedCategories = [], $searchKeyword = null, $isLocation = null)
    {
        // Calculate the offset based on the page number and records per page
        $offset = ($page - 1) * $perPage;

        // Prepare the SQL query with LIMIT, OFFSET, and ORDER BY
        $query = "SELECT * FROM jobs";

        // If selected categories are provided and not empty, filter by them
        if (!($selectedCategories[0] == 'all')) {
            $query .= " WHERE type IN ('" . implode("', '", $selectedCategories) . "')";
        } else if ($timeCriterion == 'all') {
            $query .= " WHERE 1";
        } else {
            $query .= " WHERE 1";
        }

        // Add search filter if search keyword is provided
        if ($searchKeyword !== null && $isLocation == 0) {
            $query .= " AND (topic LIKE :searchKeyword )";
        }

        if ($searchKeyword !== null && $isLocation == 1) {
            $query .= " AND (location LIKE :searchKeyword)";
        }


        if (!($timeCriterion == 'all')) {
            // Filter jobs based on the time criterion
            if ($timeCriterion == '1') {
                $query .= " AND created_at >= NOW() - INTERVAL 1 HOUR";
            } elseif ($timeCriterion == '24') {
                $query .= " AND created_at >= NOW() - INTERVAL 24 HOUR";
            } elseif ($timeCriterion == '7') {
                $query .= " AND created_at >= NOW() - INTERVAL 7 DAY";
            } elseif ($timeCriterion == '14') {
                $query .= " AND created_at >= NOW() - INTERVAL 14 DAY";
            } elseif ($timeCriterion == '30') {
                $query .= " AND created_at >= NOW() - INTERVAL 30 DAY";
            }
        }

        if ($sort_by == "created_at") {
            $query .= " ORDER BY created_at DESC";
        } elseif ($sort_by == "category") {
            $query .= " ORDER BY type";
        } elseif ($sort_by == "rate") {
            $query .= " ORDER BY rate DESC";
        }

        $query .= " LIMIT :perPage OFFSET :offset";

        // Bind parameters
        $this->db->query($query);
        $this->db->bind(':perPage', $perPage, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        if ($searchKeyword !== null) {
            $searchKeyword = '%' . $searchKeyword . '%';
            $this->db->bind(':searchKeyword', $searchKeyword);
        }
        // Execute the query
        $results = $this->db->resultset();

        return $results;
    }


    public function getJobById($job_id)
    {
        // Prepare the SQL query to fetch job details by ID
        $query = "SELECT * FROM jobs WHERE id = :job_id";

        // Bind the job ID parameter
        $this->db->query($query);
        $this->db->bind(':job_id', $job_id);

        // Execute the query
        $result = $this->db->single();

        // Check if a job with the given ID exists
        if ($this->db->rowCount() > 0) {
            return $result; // Return job details
        } else {
            return false; // Return false if job not found
        }
    }


    public function addJob($data)
    {
        // Prepare Query
        $this->db->query('INSERT INTO jobs (recruiter_id, location, rate, topic, type, website, keywords, detail, banner_img) 
        VALUES (:recruiter_id, :location, :rate, :topic, :type, :website, :keywords, :detail, :banner_image)');

        // Bind Values
        $this->db->bind(':recruiter_id', $data['recruiter_id']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':rate', $data['rate']);
        $this->db->bind(':topic', $data['topic']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':website', $data['website']);
        $this->db->bind(':keywords', $data['keywords']);
        $this->db->bind(':detail', $data['detail']);
        if (array_key_exists('banner_image', $data)) {
            // If 'banner_image' key exists, bind it to the database statement
            $this->db->bind(':banner_image', $data['banner_image']);
        } else {
            // If 'banner_image' key does not exist, bind NULL to the database statement
            $this->db->bind(':banner_image', "job-detail-bg.jpg");
        }


        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getWishlist($id)
    {
        $this->db->query("SELECT jobs.id, jobs.topic, jobs.type , wishlist.created_at
                        FROM wishlist
                        INNER JOIN jobs ON jobs.id=wishlist.job_id
                        WHERE wishlist.seeker_id = $id;");
        $results = $this->db->resultset();
        return $results;
    }
    // public function getApplications($id)
    // {
    //     $this->db->query("SELECT jobs.id, jobs.topic, jobs.type , applications.id
    //                     FROM applications
    //                     INNER JOIN jobs ON jobs.id=applications.job_id
    //                     WHERE applications.recruiter_id = $id;");
    //     $results = $this->db->resultset();
    //     return $results;
    // }

    public function getRecruiterIdByJobId($job_id)
    {
        $this->db->query("SELECT recruiter_id FROM jobs WHERE id = :job_id");
        $this->db->bind(':job_id', $job_id);
        $result = $this->db->single();
        return $result->recruiter_id;
    }

    public function getRecruiterJobs($recruiter_id)
    {
        $this->db->query("SELECT jobs.id, jobs.topic,jobs.location, jobs.type,jobs.created_at
        FROM jobs
        WHERE jobs.recruiter_id = $recruiter_id;");
        $results = $this->db->resultset();

        foreach ($results as $result) {
            $this->db->query('SELECT * FROM applications WHERE
            recruiter_id = :recruiter_id AND job_id = :job_id');

            $this->db->bind(':recruiter_id', $recruiter_id);
            $this->db->bind(':job_id', $result->id);

            $this->db->resultSet();

            $count = $this->db->rowCount();

            $result->appliedCount = $count;
        }
        return $results;
    }
}
