<?php
class Application
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Find user by email
    public function isApplied($seeker_id, $job_id)
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

    public function addtoList($data)
    {
        $this->db->query('INSERT INTO applications (seeker_id, job_id, recruiter_id) 
                        VALUES (:seeker_id, :job_id , :recruiter_id)');
        $this->db->bind(':seeker_id', $data['seeker_id']);
        $this->db->bind(':job_id', $data['job_id']);
        $this->db->bind(':recruiter_id', $data['recruiter_id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function appliedJobCount($seeker_id)
    {
        $this->db->query('SELECT COUNT(*) AS total_applications FROM applications a INNER JOIN jobs j ON j.id=a.job_id WHERE seeker_id = :seeker_id AND j.expire_in >= CURDATE() AND  j.is_deleted = 0');
        $this->db->bind(':seeker_id', $seeker_id);
        $row = $this->db->single();

        // Check if total applications is retrieved successfully
        if ($row) {
            return $row->total_applications;
        } else {
            return false;
        }
    }


    public function appliedForMoreThanFiveJobs($seeker_id)
    {
        $this->db->query('SELECT COUNT(*) AS total_applications FROM applications a INNER JOIN jobs j ON j.id=a.job_id WHERE seeker_id = :seeker_id AND j.expire_in >= CURDATE() AND  j.is_deleted = 0');
        $this->db->bind(':seeker_id', $seeker_id);
        $row = $this->db->single();

        // Check if total applications is greater than 5
        if ($row->total_applications >= 5) {
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

    public function getApplications($job_id)
    {
        $this->db->query("SELECT jobs.id, jobseekers.id AS seeker_id, jobseekers.address, jobseekers.username, jobseekers.email, jobseekers.profile_image, applications.created_at, applications.status
    FROM applications
    INNER JOIN jobs ON jobs.id = applications.job_id AND jobs.is_deleted = 0
    INNER JOIN jobseekers ON jobseekers.id = applications.seeker_id
    WHERE applications.job_id = :job_id;");

        $this->db->bind(':job_id', $job_id);
        $results = $this->db->resultset();
        return $results;
    }


    public function acceptApplication($seeker_id, $job_id)
    {
        $this->db->query('UPDATE applications SET status = :status WHERE seeker_id = :seeker_id AND job_id = :job_id');
        $this->db->bind(':status', 'approved');
        $this->db->bind(':seeker_id', $seeker_id);
        $this->db->bind(':job_id', $job_id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Method to reject an application
    public function rejectApplication($seeker_id, $job_id)
    {
        $this->db->query('UPDATE applications SET status = :status WHERE seeker_id = :seeker_id AND job_id = :job_id');
        $this->db->bind(':status', 'rejected');
        $this->db->bind(':seeker_id', $seeker_id);
        $this->db->bind(':job_id', $job_id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function acceptedApplicationCount($seeker_id)
    {
        $this->db->query('SELECT COUNT(*) AS total_applications FROM applications WHERE seeker_id = :seeker_id AND status = :status');
        $this->db->bind(':seeker_id', $seeker_id);
        $this->db->bind(':status', 'approved');
        $row = $this->db->single();

        // Check if total applications is retrieved successfully
        if ($row) {
            return $row->total_applications;
        } else {
            return false;
        }
    }
}
