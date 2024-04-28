<?php
class Moderator
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Login User
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM moderators WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    public function getUserByID($id)
    {
        $this->db->query('SELECT * FROM moderators WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
    // Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM moderators WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword($moderator_id, $new_password)
    {
        // Hash the new password before updating the database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        // Update the password in the database for the specified moderator
        $this->db->query('UPDATE moderators SET password = :password WHERE id = :id');
        $this->db->bind(':password', $hashed_password);
        $this->db->bind(':id', $moderator_id);

        // Execute the query
        if ($this->db->execute()) {
            return true; // Password updated successfully
        } else {
            return false; // Password update failed
        }
    }

    public function deleteModerator($moderator_id)
    {
        $this->db->query('UPDATE table moderator SET is_deleted=1
        WHERE id = :moderator_id');
        $this->db->bind(':moderator_id', $moderator_id);
    }

    public function getAllDisputes()
    {
        $this->db->query('SELECT * FROM disputes');
        $row = $this->db->single();
        return $this->db->resultSet();
    }


    public function getAllBRDetails()
    {
        $this->db->query('SELECT r.*, b.business_name, b.br_path, b.created_at AS application_date FROM recruiters r INNER JOIN br_details b ON r.id = b.recruiter_id where r.paid = 1');
        $row = $this->db->single();
        return $this->db->resultSet();
    }

    public function approve_validation($id)
    {
        $this->db->query('UPDATE recruiters SET is_varified = 1 WHERE id = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllTransactions()
    {
        $this->db->query('SELECT *, b.created_at AS application_date FROM recruiters r RIGHT JOIN br_details b ON r.id = b.recruiter_id');
        $row = $this->db->single();
        return $this->db->resultSet();
    }
}
