<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php if ($data['data_err'] !== '') : ?>
        <script type="text/javascript">
            Swal.fire({
                title: '<?php echo $data['data_err']; ?>',
                icon: 'error',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?php echo URLROOT ?>/jobs";
                }
            });
        </script>
    <?php elseif ($data['confirmation'] === "no") : ?>
        <script type="text/javascript">
            Swal.fire({
                title: 'Do you want to apply to this job?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, apply!',
                cancelButtonText: 'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?php echo URLROOT . '/jobs/apply/' . $data['job_id'] . '/yes'; ?>";
                } else {
                    window.location.href = "<?php echo URLROOT ?>/jobs";
                }
            });
        </script>
    <?php elseif ($data['confirmation'] === "yes") : ?>
        <script type="text/javascript">
            Swal.fire({
                title: 'You have successfully applied to this job!',
                icon: 'success',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?php echo URLROOT ?>/jobs";
                }
            });
        </script>
    <?php endif; ?>

</body>

</html>