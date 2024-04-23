<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php
    echo '<script type="text/javascript">';

    if (!empty($data['data_err'])) {
        echo 'Swal.fire({';
        echo '  icon: "error",';
        echo '  title: "' . $data['data_err'] . '",';
        echo '}).then((result) => {';
        echo '  if (result.isConfirmed) {';
        echo '    window.location.href = "' . URLROOT . '/jobs";';
        echo '  }';
        echo '});';
    } else {
        echo 'Swal.fire({';
        echo '  icon: "success",';
        echo '  title: "Job added to wishlist",';
        echo '}).then((result) => {';
        echo '  if (result.isConfirmed) {';
        echo '    window.location.href = "' . URLROOT . '/jobs";';
        echo '  }';
        echo '});';
    }

    echo '</script>';
    ?>

</body>

</html>