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

  public function applyForBR($recruiter_id, $business_name, $business_type, $registration_number, $business_address, $br)
  {
    $this->db->query('INSERT INTO br_details (recruiter_id, business_name, business_type, business_reg_no, business_address, br_path) VALUES(:recruiter_id, :business_name, :business_type, :business_reg_no, :business_address, :br_path)');
    // Bind values
    $this->db->bind(':recruiter_id', $recruiter_id);
    $this->db->bind(':business_name', $business_name);
    $this->db->bind(':business_type', $business_type);
    $this->db->bind(':business_reg_no', $registration_number);
    $this->db->bind(':business_address', $business_address);
    $this->db->bind(':br_path', $br);
    if (empty($br)) {
      return false;
    } else {
      if ($this->db->execute()) {

        $this->db->query('UPDATE recruiters SET br_uploaded = 1 WHERE id = :recruiter_id');
        $this->db->bind(':recruiter_id', $recruiter_id);
        $this->db->execute();

        return true;
      } else {
        return false;
      }
    }
  }

  public function isBrUploaded($recruiter_id)
  {
    $this->db->query('SELECT br_uploaded FROM recruiters WHERE id = :recruiter_id');
    $this->db->bind(':recruiter_id', $recruiter_id);

    if ($this->db->single()->br_uploaded == 1) {
      return true;
    } else {
      return false;
    }
  }
  public function getBrDetails($recruiter_id)
  {
    $this->db->query('SELECT * FROM br_details WHERE recruiter_id = :recruiter_id');
    $this->db->bind(':recruiter_id', $recruiter_id);

    return $this->db->single();
  }

  public function paySuccess($recruiter_id)
  {
    $this->db->query('UPDATE recruiters SET is_verified = 1 WHERE id = :recruiter_id');
    $this->db->bind(':recruiter_id', $recruiter_id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
