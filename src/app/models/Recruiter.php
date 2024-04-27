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
    $this->db->query('UPDATE recruiters SET code_verified = 1 WHERE id = :id');
    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getUserID($email)
  {
    $this->db->query('SELECT id FROM recruiters WHERE email = :email');
    $this->db->bind(':email', $email);

    return $this->db->single();
  }

  public function getRecruiterById($id)
  {
    $this->db->query('SELECT * FROM recruiters WHERE id = :id');
    $this->db->bind(':id', $id);

    return $this->db->single();
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

  public function updateProfile($data)
  {
    $this->db->query('UPDATE recruiters SET name = :name, age = :age, phone_no = :phone_no, address = :address, profile_image = :profile_image  WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':age', $data['age']);
    $this->db->bind(':phone_no', $data['phone_no']);
    $this->db->bind(':address', $data['address']);
    $this->db->bind(':profile_image', $data['profile_image']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getRecruiterProfileImage($recruiter_id)
  {
    $this->db->query('SELECT profile_image FROM recruiters WHERE id = :recruiter_id');
    $this->db->bind(':recruiter_id', $recruiter_id);

    return $this->db->single()->profile_image;
  }

  public function applyForBR($recruiter_id, $business_name, $business_type, $registration_number, $business_address, $br, $first_name, $last_name, $phone, $city, $address)
  {
    $this->db->query('INSERT INTO br_details (recruiter_id, business_name, business_type, business_reg_no, business_address, br_path, first_name, last_name, phone, city, address) VALUES(:recruiter_id, :business_name, :business_type, :business_reg_no, :business_address, :br_path, :first_name, :last_name, :phone, :city, :address)');
    // Bind values
    $this->db->bind(':recruiter_id', $recruiter_id);
    $this->db->bind(':business_name', $business_name);
    $this->db->bind(':business_type', $business_type);
    $this->db->bind(':business_reg_no', $registration_number);
    $this->db->bind(':business_address', $business_address);
    $this->db->bind(':br_path', $br);
    $this->db->bind(':first_name', $first_name);
    $this->db->bind(':last_name', $last_name);
    $this->db->bind(':phone', $phone);
    $this->db->bind(':city', $city);
    $this->db->bind(':address', $address);
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

  public function getAll()
  {
    $this->db->query('SELECT recruiters.*, COUNT(jobs.id) AS job_count 
    FROM recruiters 
    LEFT JOIN jobs ON jobs.recruiter_id = recruiters.id 
    GROUP BY recruiters.id
    ');

    return $this->db->resultSet();


     // $this->db->query("        
        // SELECT jobs.id, jobs.topic, jobs.location, jobs.type, jobs.rate, jobs.rate_type, jobs.created_at,
        // ($this->RecruiterModel->getRecruitementCount($recruiter_id)) AS recruitement_count
        // (SELECT COUNT(*) FROM applications WHERE recruiter_id = :recruiter_id AND job_id = jobs.id) AS appliedCount
        // FROM jobs
        // WHERE jobs.recruiter_id = :recruiter_id
        // ORDER BY appliedCount DESC;");
  }
  public function getRecruitementCount($recruiter_id){
    $this->db->query('SELECT COUNT(*) FROM jobs
    JOIN recruiters ON jobs.recruiter_id = recruiters.id 
  WHERE recruiters.id = :recruiter_id');
  
  
  $this->db->bind(':recruiter_id', $recruiter_id);
  // $recruiter_id = $_SESSION['business_id'];
   if($this->db->execute()){
    return true;
  }
  return false;
  
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
    $this->db->query('UPDATE recruiters SET paid = 1 WHERE id = :recruiter_id');
    $this->db->bind(':recruiter_id', $recruiter_id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getRecruiterEmail($recruiter_id)
  {
    $this->db->query('SELECT email FROM recruiters WHERE id = :recruiter_id');
    $this->db->bind(':recruiter_id', $recruiter_id);

    return $this->db->single()->email;
  }

  public function isPaid($recruiter_id)
  {
    $this->db->query('SELECT paid FROM recruiters WHERE id = :recruiter_id');
    $this->db->bind(':recruiter_id', $recruiter_id);

    if ($this->db->single()->paid == 1) {
      return true;
    } else {
      return false;
    }
  }

  public function isVerified($recruiter_id) //varified as a paid recruiter
  {
    $this->db->query('SELECT is_varified FROM recruiters WHERE id = :recruiter_id');
    $this->db->bind(':recruiter_id', $recruiter_id);

    if ($this->db->single()->is_varified == 1) {
      return true;
    } else {
      return false;
    }
  }
  

}
