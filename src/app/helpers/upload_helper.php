<?php

function generate_unique_filename($file){
  try {
     if (!empty($file)) {
        print_r($file);
         $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
         $uniqueFilename = uniqid('', true) . '.' . $fileType;
         return $uniqueFilename;
     } else {
         throw new Exception('File upload failed.');
     }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
}
}