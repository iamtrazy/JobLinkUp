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

  public function generateVerificationCode($role_id, $role)
  {
    $code = mt_rand(100000, 999999); // Generate a random 6-digit code

    $this->db->query('INSERT INTO verification_codes (role_id, role, code) VALUES(:role_id, :role, :code)');
    $this->db->bind(':role_id', $role_id);
    $this->db->bind(':role', $role);
    $this->db->bind(':code', $code);

    if ($this->db->execute()) {
      return $code; // Return the generated code
    } else {
      return false;
    }
  }

  public function getVerificationCode($role_id, $role)
  {
    $this->db->query('SELECT code FROM verification_codes WHERE role_id = :role_id AND role = :role ORDER BY created_at DESC LIMIT 1');
    $this->db->bind(':role_id', $role_id);
    $this->db->bind(':role', $role);

    return $this->db->single();
  }

  public function checkVerificationCode($role_id, $role, $code)
  {
    $verify = $this->getVerificationCode($role_id, $role);
    if ($verify) {
      if ($verify->code == $code) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function setVerified($id)
  {
    $this->db->query('UPDATE jobseekers SET code_verified = 1 WHERE id = :id');
    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getUserID($email)
  {
    $this->db->query('SELECT id FROM jobseekers WHERE email = :email');
    $this->db->bind(':email', $email);

    return $this->db->single();
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

  public function changePassword($jobseeker_id, $new_password)
  {
    // Hash the new password before updating the database
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    // Update the password in the database for the specified jobseeker
    $this->db->query('UPDATE jobseekers SET password = :password WHERE id = :id');
    $this->db->bind(':password', $hashed_password);
    $this->db->bind(':id', $jobseeker_id);

    // Execute the query
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getJobSeekerProfileImage($id)
  {
    $this->db->query('SELECT profile_image FROM jobseekers WHERE id = :id');
    $this->db->bind(':id', $id);

    return $this->db->single();
  }

  public function getJobseekerById($id)
  {
    $this->db->query('SELECT * FROM jobseekers WHERE id = :id');
    $this->db->bind(':id', $id);

    return $this->db->single();
  }

  public function editProfile($data)
  {
    $query = 'UPDATE jobseekers SET username = :username, phone_no = :phone_no, gender = :gender, website = :website, age = :age, address = :address, location_rec = :location_rec, about = :about, keywords = :keywords, linkedin_url = :linkedin_url, whatsapp_url = :whatsapp_url';

    // Conditionally add profile_image and cv columns to the query and bind values
    if (!empty($data['profile_image'])) {
      $query .= ', profile_image = :profile_image';
    }
    if (!empty($data['cv'])) {
      $query .= ', cv = :cv';
    }

    $query .= ' WHERE id = :id';

    $this->db->query($query);

    // Bind common values
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':phone_no', $data['phone_no']);
    $this->db->bind(':gender', $data['gender']);
    $this->db->bind(':website', $data['website']);
    $this->db->bind(':age', $data['age']);
    $this->db->bind(':address', $data['address']);
    $this->db->bind(':location_rec', $data['location_rec']);
    $this->db->bind(':about', $data['about']);
    $this->db->bind(':keywords', $data['keywords']);
    $this->db->bind(':linkedin_url', $data['linkedin_url']);
    $this->db->bind(':whatsapp_url', $data['whatsapp_url']);

    if (!empty($data['profile_image'])) {
      $this->db->bind(':profile_image', $data['profile_image']);
    }
    if (!empty($data['cv'])) {
      $this->db->bind(':cv', $data['cv']);
    }

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }


  public function completeProfile($id)
  {
    $this->db->query('UPDATE jobseekers SET is_complete = 1 WHERE id = :id');
    $this->db->bind(':id', $id);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
