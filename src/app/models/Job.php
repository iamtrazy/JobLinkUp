<?php
class Job
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Get All Jobs
    public function getJobs()
    {
        $this->db->query("SELECT *
                        FROM jobs");

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
