<?php
class applications
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addtoApplications($data)
    {
        // Prepare Query
        $this->db->query('INSERT INTO applications (seeker_id, job_id) 
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
    public function findApplications($seeker_id, $job_id)
    {
        $this->db->query('SELECT * FROM applications WHERE seeker_id = :seeker_id AND job_id = :job_id');
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

    public function addtoApplications($data)
    {
        $this->db->query('INSERT INTO applications (seeker_id, job_id) 
                        VALUES (:seeker_id, :job_id)');
        $this->db->bind(':seeker_id', $data['seeker_id']);
        $this->db->bind(':job_id', $data['job_id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFromApplications($data)
    {
        $this->db->query('DELETE FROM applications
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
