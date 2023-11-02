<?php
echo '<script type="text/javascript">';

if (!empty($data['data_err'])) {
    echo 'window.alert("' . $data['data_err'] . '");';
    echo 'window.location.href = "' . URLROOT . '/jobs";';
} else {
    echo 'window.alert("Job added to wishlist");';
    echo 'window.location.href = "' . URLROOT . '/jobs";';
}

echo '</script>';
?>
