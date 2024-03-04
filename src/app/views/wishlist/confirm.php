<?php
echo '<script type="text/javascript">';

if (!empty($data['data_err'])) {
    echo 'window.alert("' . $data['data_err'] . '");';
    echo 'window.location.href = "' . URLROOT . '/jobs";';
} else {
    echo 'window.alert("Job Removed from Wishlist");';
    echo 'window.location.href = "' . URLROOT . '/jobseekers/wishlist/' . $data['seeker_id'] . '";';
}

echo '</script>';
