<?php
class Job
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getJobs($page, $perPage, $sort_by, $timeCriterion, $selectedCategories = [], $searchKeyword = null, $isLocation = null)
    {
        // Calculate the offset based on the page number and records per page
        $offset = ($page - 1) * $perPage;

        // Prepare the SQL query with LIMIT, OFFSET, and ORDER BY
        $query = "SELECT j.*, r.is_varified
                  FROM jobs j 
                  LEFT JOIN recruiters r ON j.recruiter_id = r.id
                  WHERE j.is_deleted = 0";

        // If selected categories are provided and not empty, filter by them
        if (!empty($selectedCategories) && !in_array('all', $selectedCategories)) {
            $query .= " AND j.type IN ('" . implode("', '", $selectedCategories) . "')";
        }

        // Add search filter if search keyword is provided
        if ($searchKeyword !== null && $isLocation == 0) {
            $query .= " AND (j.topic LIKE :searchKeyword)";
        }

        if ($searchKeyword !== null && $isLocation == 1) {
            $query .= " AND (j.location LIKE :searchKeyword)";
        }

        // Filter jobs based on the time criterion
        if ($timeCriterion !== 'all') {
            $interval = '';
            switch ($timeCriterion) {
                case '1':
                    $interval = 'INTERVAL 1 HOUR';
                    break;
                case '24':
                    $interval = 'INTERVAL 24 HOUR';
                    break;
                case '7':
                    $interval = 'INTERVAL 7 DAY';
                    break;
                case '14':
                    $interval = 'INTERVAL 14 DAY';
                    break;
                case '30':
                    $interval = 'INTERVAL 30 DAY';
                    break;
            }
            $query .= " AND j.created_at >= NOW() - INTERVAL :interval";
        }

        $query .= " ORDER BY r.is_varified DESC, "; // Sorting by is_varified first
        switch ($sort_by) {
            case "created_at":
                $query .= "j.created_at DESC";
                break;
            case "category":
                $query .= "j.type";
                break;
            case "rate":
                $query .= "j.rate DESC";
                break;
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
        if ($timeCriterion !== 'all') {
            $this->db->bind(':interval', $interval);
        }

        // Execute the query
        $results = $this->db->resultset();

        return $results;
    }




    public function getJobById($job_id)
    {
        // Prepare the SQL query to fetch job details by ID, joining with recruiters table
        $query = "SELECT j.*, r.is_varified, r.name AS recruiter_name, b.business_name , r.profile_image
                  FROM jobs j 
                  LEFT JOIN recruiters r ON j.recruiter_id = r.id 
                  LEFT JOIN br_details b ON r.id = b.recruiter_id
                  WHERE j.id = :job_id AND j.is_deleted = 0";

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


    public function appliedCount($job_id)
    {
        $this->db->query("SELECT COUNT(*) AS count FROM applications WHERE job_id = :job_id");
        $this->db->bind(':job_id', $job_id);
        $result = $this->db->single();
        return $result;
    }

    public function increaseViewCount($job_id)
    {
        $this->db->query("UPDATE jobs SET view_count = view_count + 1 WHERE id = :job_id");
        $this->db->bind(':job_id', $job_id);
        $this->db->execute();
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

    public function updateJob($data)
    {
        // Prepare Query
        $this->db->query('UPDATE jobs SET location = :location, rate = :rate, topic = :topic, type = :type, website = :website, keywords = :keywords, detail = :detail, banner_img = :banner_image WHERE id = :job_id');

        // Bind Values
        $this->db->bind(':job_id', $data['job_id']);
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


    public function deleteJob($job_id)
    {
        // Prepare Query
        $this->db->query('UPDATE jobs SET is_deleted = 1 WHERE id = :job_id');

        // Bind Values
        $this->db->bind(':job_id', $job_id);

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

    public function getApplication($id)
    {
        $this->db->query("SELECT jobs.id, jobs.topic, jobs.location ,jobs.rate, jobs.rate_type , applications.created_at, applications.status
        FROM applications
        INNER JOIN jobs ON jobs.id=applications.job_id
        WHERE applications.seeker_id = $id;");
        $results = $this->db->resultset();
        return $results;
    }

    public function getRecruiterIdByJobId($job_id)
    {
        $this->db->query("SELECT recruiter_id FROM jobs WHERE id = :job_id");
        $this->db->bind(':job_id', $job_id);
        $result = $this->db->single();
        return $result->recruiter_id;
    }

    public function reportJob($seeker_id, $job_id, $recruiter_id, $reason)
    {
        // Check if the user has already reported the same job
        $this->db->query('SELECT * FROM disputes WHERE seeker_id = :seeker_id AND job_id = :job_id');
        $this->db->bind(':seeker_id', $seeker_id);
        $this->db->bind(':job_id', $job_id);
        $existingReport = $this->db->single();

        // If the user has already reported the job, return false
        if ($existingReport) {
            return false;
        }

        // Prepare Query
        $this->db->query('INSERT INTO disputes (seeker_id, job_id, recruiter_id, reason) 
        VALUES (:seeker_id, :job_id, :recruiter_id, :reason)');

        // Bind Values
        $this->db->bind(':seeker_id', $seeker_id);
        $this->db->bind(':job_id', $job_id);
        $this->db->bind(':recruiter_id', $recruiter_id);
        $this->db->bind(':reason', $reason);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRecruiterJobs($recruiter_id)
    {   
        // $job_id = $this->db->query('SELECT jobs.recruiter_id from jobs where jobs.recruiter_id = $recruiter_id');
        $this->db->query("
            SELECT jobs.id, jobs.topic, jobs.location, jobs.type, jobs.rate, jobs.rate_type, jobs.created_at,
            (SELECT COUNT(*) FROM applications WHERE recruiter_id = :recruiter_id AND job_id = jobs.id) AS appliedCount
            FROM jobs
            WHERE jobs.recruiter_id = :recruiter_id AND jobs.is_deleted = 0
            ORDER BY appliedCount DESC;");

        $this->db->bind(':recruiter_id', $recruiter_id);

        // $job_id = jobs.id;
        // $this->deleteJob($job_id);


        $results = $this->db->resultset();

        return $results;
    }


    public function deleteJobByjobId($job_id) {
        // Update the record to mark it as deleted
        $sql = "UPDATE jobs SET is_deleted = true WHERE id = ?";
        $this->db->query($sql, [$job_id]);
    
        // Check if the query was successful
        if ($this->db->rowCount() > 0) {
            echo "Record deleted successfully";
        } else {
            echo "Job couldnt be deleted";
        }
    }
    


}
