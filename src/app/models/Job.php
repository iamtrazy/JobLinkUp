<?php
class Job
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function totalJobs()
    {
        $this->db->query("SELECT COUNT(*) AS total_jobs FROM jobs");
        $row = $this->db->single();
        return $row;
    }

    public function getJobs($page, $perPage, $sort_by)
    {
        // Calculate the offset based on the page number and records per page
        $offset = ($page - 1) * $perPage;

        // Prepare the SQL query with LIMIT, OFFSET, and ORDER BY
        if ($sort_by == "created_at") {
            $query = "SELECT * FROM jobs ORDER BY created_at DESC LIMIT :perPage OFFSET :offset";
        } else if ($sort_by == "category") {
            $query = "SELECT * FROM jobs ORDER BY category LIMIT :perPage OFFSET :offset";
        } else if ($sort_by == "rate") {
            $query = "SELECT * FROM jobs ORDER BY rate DESC LIMIT :perPage OFFSET :offset";
        }

        // Bind parameters
        $this->db->query($query);
        $this->db->bind(':perPage', $perPage, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);

        // Execute the query
        $results = $this->db->resultset();

        return $results;
    }


    public function addJob($data)
    {
        // Prepare Query
        $this->db->query('INSERT INTO jobs ( recruiter_id, location, rate, topic, type, website, category, detail) 
        VALUES (:recruiter_id, :location, :rate, :topic, :type, :website, :category, :detail)');

        // Bind Values
        $this->db->bind(':recruiter_id', $data['recruiter_id']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':rate', $data['rate']);
        $this->db->bind(':topic', $data['topic']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':website', $data['website']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':detail', $data['detail']);

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
}
