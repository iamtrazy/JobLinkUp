<?php
class Jobseeker
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // Regsiter user
  public function register($data)
  {
    $this->db->query('INSERT INTO jobseekers (username, email, gender, password) VALUES(:name, :email, :gender, :password)');
    // Bind values
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);
    $this->db->bind(':gender', $data['gender']);

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
    $this->db->query('SELECT * FROM jobseekers WHERE email = :email');
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
    $this->db->query('SELECT * FROM jobseekers WHERE email = :email');
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function getJobseekerById($id)
  {
    $this->db->query('SELECT * FROM jobseekers WHERE id = :id');
    $this->db->bind(':id', $id);

    return $this->db->single();
  }

  public function editProfile($data)
  {
    $this->db->query('UPDATE jobseekers SET username = :username, gender = :gender, website = :website, age = :age, address = :address, linkedin_url = :linkedin_url, whatsapp_url = :whatsapp_url WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':gender', $data['gender']);
    $this->db->bind(':website', $data['website']);
    $this->db->bind(':age', $data['age']);
    $this->db->bind(':address', $data['address']);
    $this->db->bind(':linkedin_url', $data['linkedin_url']);
    $this->db->bind(':whatsapp_url', $data['whatsapp_url']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
