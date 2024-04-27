<?php

function getStatusColor($status)
{
    switch ($status) {
        case 'pending':
            return 'yellow';
        case 'approved':
            return 'lightgreen'; // Change to light green
        case 'rejected':
            return 'red';
        default:
            return 'grey';
    }
}


function getStatusText($status)
{
    switch ($status) {
        case 'pending':
            return 'Pending';
        case 'approved':
            return 'Accepted';
        case 'rejected':
            return 'Rejected';
        default:
            return 'Unknown';
    }
}
?>
<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>
<div class="col-lg-8 col-md-12 my-section-2">
    <!--Filter Short By-->
    <div class="product-filter-wrap justify-content-between align-items-right m-b30">
        <span class="woocommerce-result-count-left" style="float: right;">Showing <?php echo count($data['applications']) ?> Candidates</span>
    </div>
    <div class="twm-candidates-list-wrap">
        <ul>
            <?php foreach ($data['applications'] as $application) : ?>
                <div class="twm-candidates-list-style1 mb-5">
                    <div class="twm-media">
                        <div class="twm-media-pic">
                            <img src="<?php echo URLROOT . '/img/profile/' . $application->profile_image ?>" alt="#">
                        </div>
                        <?php $time_elapsed = time_elapsed_string($application->created_at);

                        if (strpos($time_elapsed, 'hours') !== false || strpos($time_elapsed, 'hour') !== false || strpos($time_elapsed, 'minutes') !== false || strpos($time_elapsed, 'minute') !== false || strpos($time_elapsed, 'now') !== false) {
                            echo '
                        <div class="twm-candidates-tag"><span>New Candidate</span></div>';
                        } ?>
                    </div>
                    <div class="twm-mid-content">
                        <a href="candidate-detail.html" class="twm-job-title">
                            <h4> <?php echo $application->username ?> </h4>
                        </a>
                        <p><?php echo $application->email ?></p>
                        <div class="twm-fot-content">
                            <div class="twm-left-info">
                                <p class="twm-candidate-address"><i class="fas fa-map-marker-alt"></i><?php echo $application->address ?></p>
                                <div class="twm-jobs-vacancies"><span><?php echo 'Applied ' . time_elapsed_string($application->created_at) ?></span></div>
                            </div>
                            <span class="status-label" style="background-color: <?php echo getStatusColor($application->status); ?>">
                                <?php echo getStatusText($application->status); ?>
                            </span>
                            <div class="twm-right-btn">
                                <a href="<?php echo URLROOT . '/candidates/profile/' . $application->seeker_id ?>" class="twm-view-prifile site-text-primary">View Profile</a>
                            </div>
                         
                        </div>
                        <a href="#" class="twm-btn twm-btn-accept" data-seeker-id="<?php echo $application->seeker_id ?>" data-job-id="<?php echo $application->id ?>"><i class="fas fa-check"></i> Accept</a>
                        <a href="#" class="twm-btn twm-btn-reject" data-seeker-id="<?php echo $application->seeker_id ?>" data-job-id="<?php echo $application->id ?>"><i class="fas fa-times"></i> Reject</a>

                    </div>
                </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Handle click event for accept button
        $('.twm-btn-accept').on('click', function(e) {
            e.preventDefault();
            const seekerId = $(this).data('seeker-id');
            const jobId = $(this).data('job-id');

            // Display SweetAlert prompt
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to accept this application',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send API request to accept the application
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo URLROOT . '/recruiters/acceptApplication'; ?>',
                        data: {
                            seeker_id: seekerId,
                            job_id: jobId
                        },
                        success: function(response) {
                            // Show success message using SweetAlert
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                            }).then((result) => {
                                if (result.isConfirmed || result.isDismissed) {
                                    // Reload the page
                                    location.reload();
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            // Show error message using SweetAlert
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to accept application',
                                icon: 'error',
                            });
                        }
                    });
                }
            });
        });

        // Handle click event for reject button
        $('.twm-btn-reject').on('click', function(e) {
            e.preventDefault();
            const seekerId = $(this).data('seeker-id');
            const jobId = $(this).data('job-id');

            // Display SweetAlert prompt
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to reject this application',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send API request to reject the application
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo URLROOT . '/recruiters/rejectApplication'; ?>',
                        data: {
                            seeker_id: seekerId,
                            job_id: jobId
                        },
                        success: function(response) {
                            // Show success message using SweetAlert
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                            }).then((result) => {
                                if (result.isConfirmed || result.isDismissed) {
                                    // Reload the page
                                    location.reload();
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            // Show error message using SweetAlert
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to reject application',
                                icon: 'error',
                            });
                        }
                    });
                }
            });
        });
    });
</script>



<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>