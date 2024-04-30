<?php

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\DropboxFile;

function uploadToDropbox($client_id, $client_secret, $access_token, $file_path, $dropbox_path) {
    // Create a DropboxApp instance
    $app = new DropboxApp($client_id, $client_secret, $access_token);

    // Create a Dropbox instance
    $dropbox = new Dropbox($app);

    // Create a DropboxFile instance from the local file
    $dropboxFile = new DropboxFile($file_path);

    try {
        // Upload the file to Dropbox
        $fileMetadata = $dropbox->upload($dropboxFile, $dropbox_path, ['autorename' => true]);

        // If successful, return the metadata of the uploaded file
        return $fileMetadata;
    } catch (Exception $e) {
        print_r($e->getMessage());
        // Handle any errors
        return false;
    }
}
?>
