<?php
class Admin
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // Login User
  public function login($email, $password)
  {
    $this->db->query('SELECT * FROM admins WHERE email = :email');
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
    $this->db->query('SELECT * FROM admins WHERE email = :email');
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function findModeratorByEmail($email)
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

  // Add admin
  public function addadmin($data)
  {
    $this->db->query('INSERT INTO moderators (name, email, password) VALUES(:name, :email, :password)');
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
  // Get Moderator Details
  public function getModeratorDetails(){
    $this->db->query ('SELECT * FROM moderators' );
    $row = $this->db->single();
    
    return $this->db->resultSet();

  }
  public function deleteModerator($moderator_id){
    $this->db->query('UPDATE table moderator SET is_deleted=1
    WHERE id = :moderator_id');
    $this->db->bind(':moderator_id',$moderator_id);
}
  public function publishNotice($data){
    $this->db->query ('INSERT into notices VALUES (:notice_id,:title,:description,:link)');
     // Execute
    
     $this->db->bind(':notice_id', $data['notice_id']);
     $this->db->bind(':title', $data['title']);
     $this->db->bind(':description', $data['description']);
     $this->db->bind(':link', $data['link']);
     $this->db->bind(':created_at', $data['created_at']);
     $this->db->bind(':expiry_date', $data['expiry_date']);
     if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getNotices(){
    $this->db->query ('SELECT * from notices');
    $row = $this->db->single();
    
    return $this->db->resultSet();
  }

 
}
