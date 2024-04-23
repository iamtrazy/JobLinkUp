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

        $this->db->query("SELECT jobs.id, jobseekers.id, jobseekers.address,jobseekers.username, jobseekers.profile_image
        FROM applications
        INNER JOIN jobs ON jobs.id = applications.job_id
        INNER JOIN jobseekers ON jobseekers.id = applications.seeker_id
        WHERE applications.job_id = :job_id;");

        $this->db->bind(':job_id', $job_id);
        $results = $this->db->resultset();
        return $results;
    }
}


// <?php
// class Application
// {
//     private $db;

//     public function __construct()
//     {
//         $this->db = new Database;
//     }

//     public function apply($data)
//     {
//         // Prepare Query
//         $this->db->query('INSERT INTO jobs_applied (seeker_id, job_id) 
//         VALUES (:seeker_id, :job_id)');

//         // Bind Values
//         $this->db->bind(':seeker_id', $data['seeker_id']);
//         $this->db->bind(':job_id', $data['job_id']);

//         //Execute
//         if ($this->db->execute()) {
//             return true;
//         } else {
//             return false;
//         }
//     }

//     // Find user by email
//     public function isApplied($seeker_id, $job_id)
//     {
//         $this->db->query('SELECT * FROM jobs_applied WHERE seeker_id = :seeker_id AND job_id = :job_id');
//         $this->db->bind(':seeker_id', $seeker_id);
//         $this->db->bind(':job_id', $job_id);

//         $row = $this->db->single();

//         // Check row
//         if ($this->db->rowCount() > 0) {
//             return true;
//         } else {
//             return false;
//         }
//     }

//     public function addtoList($data)
//     {
//         $this->db->query('INSERT INTO jobs_applied (seeker_id, job_id) 
//                         VALUES (:seeker_id, :job_id)');
//         $this->db->bind(':seeker_id', $data['seeker_id']);
//         $this->db->bind(':job_id', $data['job_id']);
//         if ($this->db->execute()) {
//             return true;
//         } else {
//             return false;
//         }
//     }

//     public function deleteFromList($data)
//     {
//         $this->db->query('DELETE FROM jobs_applied
//                         WHERE seeker_id= :seeker_id 
//                         AND job_id = :job_id');
//         $this->db->bind(':seeker_id', $data['seeker_id']);
//         $this->db->bind(':job_id', $data['job_id']);
//         if ($this->db->execute()) {
//             return true;
//         } else {
//             return false;
//         }
//     }
// }
