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
  public function loadform(){
    //load more comments
  }
  
 //public function jseditrecruiterdetails($email){
  
  
  
  
  // Prepare SQL statement
  //$database->query('SELECT * FROM recruiters WHERE email = :email');
  
  // Bind parameter
 // $database->bind(':email', $email);
  
  // Execute the query
  //$database->execute();
  
  // Check if user exists
 // if ($database->rowCount() > 0) {
      // User exists
  //    echo json_encode(array('exists' => true));
  //} else {
      // User does not exist
  //    echo json_encode(array('exists' => false));
  //}

 
  
    // Login User
  


}

