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

  public function getAll()
  {
    $this->db->query('SELECT * FROM jobseekers');

    return $this->db->resultSet();
  }


  public function applyForBR($data){
    $this->db->query('INSERT INTO br_details (application_id,recruiter_id,website,business_email,business_contact_no,business_name,business_type,business_reg_no,business_address,contact_person,contact_email,contact_number,agree_to_terms) 
    VALUES (:application_id,:recruiter_id,:website,:business_email,:business_contact_no,:business_name,:business_type,:business_reg_no,:business_address,:contact_person,:contact_email,:contact_number,:agree_to_terms)');
    $this->db->bind(':application_id', $data['application_id']);
    $this->db->bind(':recruiter_id', $data['recruiter_id']);
    $this->db->bind(':website', $data['website']);
    $this->db->bind(':business_email', $data['business_email']);
    $this->db->bind(':business_contact_no', $data['business_contact_no']);
    $this->db->bind(':business_name', $data['business_name']);
    $this->db->bind(':business_type', $data['business_type']);
    $this->db->bind(':business_reg_no', $data['business_reg_no']);
    $this->db->bind(':business_address', $data['business_address']);
    $this->db->bind(':contact_person', $data['contact_person']);
    $this->db->bind(':contact_email', $data['contact_email']);
    $this->db->bind(':contact_number', $data['contact_number']);
    $this->db->bind(':agree_to_terms', $data['agree_to_terms']);
    if($this->db->execute()){
      return true;

  }
  return false;

}
}