<?php
class Wishlist
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addtoWishlist($data)
    {
        // Prepare Query
        $this->db->query('INSERT INTO wishlist (seeker_id, job_id) 
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
    public function findWishlist($seeker_id, $job_id)
    {
        $this->db->query('SELECT * FROM wishlist WHERE seeker_id = :seeker_id AND job_id = :job_id');
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
        $this->db->query('INSERT INTO wishlist (seeker_id, job_id) 
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
        $this->db->query('DELETE FROM wishlist
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

    public function wishlistedJobCount($seeker_id)
    {
        $this->db->query('SELECT COUNT(*) AS total_wishlist FROM wishlist WHERE seeker_id = :seeker_id');
        $this->db->bind(':seeker_id', $seeker_id);
        $row = $this->db->single();

        // Check if total applications is retrieved successfully
        if ($row) {
            return $row->total_wishlist;
        } else {
            return false;
        }
    }
}
