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

    public function deleteModerator($moderator_id){
        $this->db->query('UPDATE table moderator SET is_deleted=1
        WHERE id = :moderator_id');
        $this->db->bind(':moderator_id',$moderator_id);
    }

    // Method to accept an application
    public function acceptDispute($dispute_id)
    {
        $this->db->query('UPDATE disputes SET status = :status 
        WHERE dispute_id = :dispute_id');
        $this->db->bind(':status', 'approved');
        $this->db->bind(':dispute_id', $dispute_id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function rejectDispute($dispute_id)
    {
        $this->db->query('UPDATE disputes SET status = :status 
        WHERE dispute_id = :dispute_id');
        $this->db->bind(':status', 'rejected');
        $this->db->bind(':dispute_id', $dispute_id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getAllDisputes(){
        $this->db->query('SELECT * FROM disputes');
        $row = $this->db->single();
        return $this->db->resultSet();

    //result set statement

    }

   
        // public function findDuplicateDisputes(){
        //     // Construct the compound key by concatenating seeker_id and job_id
        //     $compoundKey = 'seekerID_' . 'job_id'; // Adjust this based on your actual column names and desired format
        
        //     // Execute the query to retrieve seeker_id and job_id from the disputes table
        //     $query = $this->db->query('SELECT seeker_id, job_id FROM disputes');
        
        //     // Check if the query was executed successfully
        //     if ($query) {
        //         // Fetch the results (assuming your database library provides a method for fetching results)
        //         $results = $query->fetchAll(); // Adjust this based on your database library
        
        //         // Process the results as needed
        //         foreach ($results as $row) {
        //             // Access the seeker_id and job_id values from each row
        //             $seekerId = $row['seeker_id'];
        //             $jobId = $row['job_id'];
        
        //             // Use the values to check for duplicate disputes or perform other operations
        //             // For example, you can compare $seekerId and $jobId with the compoundKey
        //             if (($seekerId . '_' . $jobId) === $compoundKey) {
        //                 // Handle the duplicate dispute
        //                 // This could involve logging, reporting, or taking corrective actions
        //                 // Example: Log the occurrence of a duplicate dispute
        //                 echo "No disputes found in the database<br>";

        //             }
        //         }
        //     } else {
        //         // Handle the case where the query execution failed
        //         // Example: Log an error message or throw an exception
        //         error_log("Failed to execute the query to retrieve disputes");
        //     }
        // }
        
    }


