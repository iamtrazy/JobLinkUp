<?php require APPROOT . '/views/inc/admin_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30" style="margin-top: 25%;">
    <div class="twm-right-section-panel site-bg-gray">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="text-center">
                    <button id="backupButton" class="site-button btn-lg btn-primary"><i class="fas fa-cloud-download-alt"></i> Backup Now</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-4" style="margin-bottom: 10%; padding: 20px;" ;>
                    <p>Backup your data to Dropbox using their API. Learn more about the Dropbox API and its documentation <a href="https://www.dropbox.com/developers/documentation" target="_blank">here</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#backupButton').click(function() {
            // Show Sweet Alert confirmation dialog
            Swal.fire({
                title: 'Backup Now',
                text: 'Are you sure you want to create and upload a backup?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, backup it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading screen
                    Swal.fire({
                        title: 'Backup in progress',
                        html: 'Please wait...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Send POST request to the backup API endpoint
                    $.post('/admins/backup', function(response) {
                        // Check the response status
                        if (response.status === 'success') {
                            // Show success message
                            Swal.fire({
                                title: 'Backup Complete',
                                text: response.message,
                                icon: 'success',
                                allowOutsideClick: false,
                                confirmButtonText: 'OK'
                            });
                        } else {
                            // Show error message
                            Swal.fire({
                                title: 'Backup Failed',
                                text: response.message,
                                icon: 'error',
                                allowOutsideClick: false,
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        });
    });
</script>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>