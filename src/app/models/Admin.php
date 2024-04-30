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
  public function getModeratorDetails()
  {
    $this->db->query('SELECT * FROM moderators');
    $row = $this->db->single();
    return $this->db->resultSet();
  }

  public function deleteModerator($moderator_id)
  {
    $this->db->query('UPDATE moderators SET is_disabled = 1 WHERE id = :moderator_id');
    $this->db->bind(':moderator_id', $moderator_id);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function restoreModerator($moderator_id)
  {
    $this->db->query('UPDATE moderators SET is_disabled = 0 WHERE id = :moderator');
    $this->db->bind(':moderator', $moderator_id);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function updateAds($title, $text, $url, $color, $admin_id, $type)
  {
    $this->db->query('UPDATE ads SET title = :title, text = :text, url = :url, color = :color, admin_id = :admin_id WHERE type = :type');
    // Bind values
    $this->db->bind(':admin_id', $admin_id);
    $this->db->bind(':type', $type);
    $this->db->bind(':title', $title);
    $this->db->bind(':text', $text);
    $this->db->bind(':url', $url);
    $this->db->bind(':color', $color);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function countJobs()
  {
    $this->db->query('SELECT * FROM jobs');
    $row = $this->db->single();
    return $this->db->rowCount();
  }

  public function countRecruiters()
  {
    $this->db->query('SELECT * FROM recruiters');
    $row = $this->db->single();
    return $this->db->rowCount();
  }

  public function countJobSeekers()
  {
    $this->db->query('SELECT * FROM jobseekers');
    $row = $this->db->single();
    return $this->db->rowCount();
  }

  public function totalIncome()
  {
    $this->db->query('SELECT count(*) FROM recruiters where is_varified = 1');
    $row = $this->db->single();
    return $this->db->rowCount();
  }

  public function jobAd()
  {
    $this->db->query('SELECT * FROM ads WHERE type = 1 LIMIT 1');
    $row = $this->db->single();
    return $row;
  }

  public function candidateAd()
  {
    $this->db->query('SELECT * FROM ads WHERE type = 2 LIMIT 1');
    $row = $this->db->single();
    return $row;
  }

  public function publishNotice($data)
  {
    $this->db->query('INSERT into notices VALUES (:notice_id,:title,:description,:link)');
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

  public function getNotices()
  {
    $this->db->query('SELECT * from notices');
    $row = $this->db->single();

    return $this->db->resultSet();
  }

  public function insertDropBoxKeys($client_id, $client_secret, $access_token, $admin_id)
  {
    $this->db->query('INSERT INTO dropbox_keys (client_id, client_secret, access_token, admin_id) VALUES (:client_id, :client_secret, :access_token, :admin_id)');
    $this->db->bind(':client_id', $client_id);
    $this->db->bind(':client_secret', $client_secret);
    $this->db->bind(':access_token', $access_token);
    $this->db->bind(':admin_id', $admin_id);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function updateDropBoxKeys($client_id, $client_secret, $access_token, $admin_id)
  {
    $this->db->query('UPDATE dropbox_keys SET client_id = :client_id, client_secret = :client_secret, access_token = :access_token WHERE admin_id = :admin_id');
    $this->db->bind(':client_id', $client_id);
    $this->db->bind(':client_secret', $client_secret);
    $this->db->bind(':access_token', $access_token);
    $this->db->bind(':admin_id', $admin_id);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function isDropBoxKeysPresent($admin_id)
  {
    $this->db->query('SELECT * FROM dropbox_keys WHERE admin_id = :admin_id');
    $this->db->bind(':admin_id', $admin_id);
    $row = $this->db->single();
    if ($row) {
      return true;
    } else {
      return false;
    }
  }

  public function getDropBoxKeys($admin_id)
  {
    $this->db->query('SELECT * FROM dropbox_keys WHERE admin_id = :admin_id');
    $this->db->bind(':admin_id', $admin_id);
    $row = $this->db->single();
    return $row;
  }

  public function backups($path)
  {
    $filename = 'joblinkup_' . date('Y_m_d_His') . '.sql';
    $path = $path . '/' . $filename;
    dump_database($path);
    if (file_exists($path)) {
      return $filename;
    } else {
      return false;
    }
  }

  public function upload_database($client_id, $client_secret, $access_token, $file_path, $dropbox_path)
  {
    if (uploadToDropbox($client_id, $client_secret, $access_token, $file_path, $dropbox_path)) {
      return true;
    } else {
      return false;
    }
  }
}
