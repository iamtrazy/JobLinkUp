<?php
class Recruiter
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // Regsiter user
  public function register($data)
  {
    $this->db->query('INSERT INTO recruiters (name, email, password) VALUES(:name, :email, :password)');
    // Bind values
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Login User
  public function login($email, $password)
  {
    $this->db->query('SELECT * FROM recruiters WHERE email = :email');
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    $hashed_password = $row->password;
    if (password_verify($password, $hashed_password)) {
      return $row;
    } else {
      return false;
    }
  }

  // Find user by email
  public function findUserByEmail($email)
  {
    $this->db->query('SELECT * FROM recruiters WHERE email = :email');
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function applyBR($data){
    
    $this->db->query('INSERT INTO business_profiles_uploaded VALUES(:recruiter_id, :business_name, :business_email, :business_address :);
    $this->db->query('INSERT into business_profiles_uploaded VALUES (NULL, 2,3,'2023-05-01',true)');
    // Bind values
    $this->db->bind(':business_name', $data['name']);
    $this->db->bind(':recruiter_id', $data['recruiter_id']);
    $this->db->bind(':business_email', $data['business_email']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }

    
  }
  
  
  
  


}

