<?php
/*
   * Base Controller
   * Loads the models and views
   */
class Controller
{
  // Load model
  public function model($model)
  {
    // Require model file
    require_once '../app/models/' . $model . '.php';

    // Instatiate model
    return new $model();
  }

  // Load view
  public function view($view, $data = [])
  {
    // Check for view file
    if (file_exists('../app/views/' . $view . '.php')) {
      require_once '../app/views/' . $view . '.php';
    } else {
      // View does not exist
      die('View does not exist');
    }
  }

  public function upload_media($image_name, $file, $path, $allowed_types = ['jpg', 'jpeg', 'png'], $size_limit = 1000000)
  {
    $info = new SplFileInfo($file[$image_name]['name']);
    $uniqueFilename = uniqid('', true) . '.' . $info->getExtension();
    $target_file = UPLOADROOT . $path . $uniqueFilename;
    // Move the uploaded file
    if (move_uploaded_file($file[$image_name]['tmp_name'], $target_file)) {
      //allow only 100 mega bytes
      if ($file[$image_name]["size"] > $size_limit) {
        unlink($target_file); // Delete the uploaded file if it exceeds the file size limit
        return false;
      }
      // Check file type
      $FileType = strtolower($info->getExtension());
      if (!in_array($FileType, $allowed_types)) {
        unlink($target_file); // Delete the uploaded file if it has an invalid file type
        return false;
      }
      return $uniqueFilename; // All checks passed, return the unique filename
    } else {
      return false; // Error uploading file
    }
  }
}
