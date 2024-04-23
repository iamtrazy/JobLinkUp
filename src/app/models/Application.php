<?php
class Application
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
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
    public function viewApplications($data)
    {
        $this->db->query('SELECT * FROM applications
        WHERE job_id = :job_id
        AND ');
        $this->db->bind(':job_id', $data['job_id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getApplications($id)
    {
        $this->db->query("SELECT jobs.id, jobs.topic, jobs.type , applications.created_at
                        FROM applications
                        INNER JOIN jobs ON jobs.id=applications.job_id
                        WHERE applications.seeker_id = :id;");
        $this->db->bind(':id', $id);
        $results = $this->db->resultset();
        return $results;
    }
}
