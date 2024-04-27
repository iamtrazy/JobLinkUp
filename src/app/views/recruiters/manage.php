<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">
        <form>
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i>Manage jobs</h4>
                </div>
                <div class="panel-body wt-panel-body m-b30 ">
                    <div class="twm-D_table p-a20 table-responsive">
                        <table id="jobs_bookmark_table" class="table table-bordered twm-bookmark-list-wrap">
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th>Job Types</th>
                                    <th>Rate</th>
                                    <th>Applications</th>
                                    <!-- <th>Status</th> -->
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['jobs'] as $job) : ?>
                                    <tr>
                                        <td>
                                            <div class="twm-bookmark-list">
                                                <div class="twm-mid-content">
                                                    <a href="#" class="twm-job-title">
                                                        <h4><?php echo $job->topic ?></h4>
                                                        <p class="twm-bookmark-address">
                                                            <i class="fas fa-map-marker-alt"></i><?php echo $job->location; ?>
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo $job->type; ?></td>
                                        <td>
                                            <?php echo $job->rate ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary"><?php echo $job->appliedCount; ?></span>
                                            <a href="<?php echo URLROOT . '/recruiters/applications/' . $job->id ?>" class="view-applicants" style="margin-left: 10px;">
                                                View Applicants
                                            </a>
                                        </td>
                                      

                                        <td>
                                            <span class="text-clr-green2"><?php echo time_elapsed_string($job->created_at); ?></span>
                                        </td>
                                        <td>
                                            <div class="twm-table-controls">
                                                <ul class="twm-DT-controls-icon list-unstyled">
                                                    <li>
                                                        <button title="Edit Job" type="button" data-bs-toggle="tooltip" data-bs-placement="top" class="edit-job" data-job-id="<?php echo $job->id ?>">
                                                            <span class="fa fa-edit"></span>
                                                        </button>

                                                    </li>
                                                    <li>
                                                        <button class="delete-job" title="Remove Job" data-bs-toggle="tooltip" data-bs-placement="top" data-job-id="<?php echo $job->id ?>">
                                                            <span class="far fa-trash-alt"></span>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Function to handle job deletion
        $('.delete-job').on('click', function(e) {
            e.preventDefault();
            var jobId = $(this).data('job-id');

            // Show confirmation dialog using SweetAlert2
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this job!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms deletion, send AJAX request to delete the job
                    $.ajax({
                        url: '<?php echo URLROOT . '/recruiters/deletejob/' ?>' + jobId,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                // If job is deleted successfully, show success message
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    // Reload the page after successful deletion
                                    location.reload();
                                });
                            } else {
                                // If deletion fails, show error message
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error deleting job:", error);
                            // Show generic error message if AJAX request fails
                            Swal.fire(
                                'Error!',
                                'Failed to delete job. Please try again later.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        // Function to handle click on "Edit Job" button
        $('.edit-job').on('click', function(e) {
            e.preventDefault();
            var jobId = $(this).data('job-id');
            // Redirect to the edit job page
            window.location.href = '<?php echo URLROOT . '/recruiters/editjob/' ?>' + jobId;
        });
    });
</script>


<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>