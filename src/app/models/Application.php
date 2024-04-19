<?php
class Application
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function apply($data)
    {
        // Prepare Query
        $this->db->query('INSERT INTO jobs_applied (seeker_id, job_id) 
        VALUES (:seeker_id, :job_id)');

        // Bind Values
        $this->db->bind(':seeker_id', $data['seeker_id']);
        $this->db->bind(':job_id', $data['job_id']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Find user by email
    public function isApplied($seeker_id, $job_id)
    {
        $this->db->query('SELECT * FROM jobs_applied WHERE seeker_id = :seeker_id AND job_id = :job_id');
        $this->db->bind(':seeker_id', $seeker_id);
        $this->db->bind(':job_id', $job_id);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addtoList($data)
    {
        $this->db->query('INSERT INTO jobs_applied (seeker_id, job_id) 
                        VALUES (:seeker_id, :job_id)');
        $this->db->bind(':seeker_id', $data['seeker_id']);
        $this->db->bind(':job_id', $data['job_id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFromList($data)
    {
        $this->db->query('DELETE FROM jobs_applied
                        WHERE seeker_id= :seeker_id 
                        AND job_id = :job_id');
        $this->db->bind(':seeker_id', $data['seeker_id']);
        $this->db->bind(':job_id', $data['job_id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
