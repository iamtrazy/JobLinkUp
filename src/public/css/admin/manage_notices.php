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
                                    <th>Notice Title</th>
                                    <th>Notice Description</th>
                                    <th>links</th>
                                    <th>Permissions</th>
                                    <!-- <th>Status</th> -->
                                    <th>Date_published</th>
                                    <th>expiry_date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['notices'] as $notice) : ?>
                                    <tr>
                                        <td>
                                            <div class="twm-bookmark-list">
                                                <div class="twm-mid-content">
                                                    <a href="#" class="twm-job-title">
                                                        <h4><?php echo $notice->title ?></h4>
                                                        <p class="twm-bookmark-address">
                                                            <i class="fas fa-map-marker-alt"></i><?php echo $notice->description; ?>
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                       
                                        <td><?php echo $notice->permissons; ?></td>
                                        <td><?php echo $notice->link; ?></td>
                                        <td>
                                            <?php echo $notice->created_at;?>
                                        </td>
                                        <td>
                                            <?php echo $notice->expiry_date;?>
                                        </td>

                                        <td>
                                            <span class="text-clr-green2"><?php echo time_elapsed_string($notice->created_at); ?></span>
                                        </td>
                                        <td>
                                            <div class="twm-table-controls">
                                                <ul class="twm-DT-controls-icon list-unstyled">
                                                    <li>
                                                        <button title="Edit notice" type="button" data-bs-toggle="tooltip" data-bs-placement="top" class="edit-job" data-job-id="<?php echo $notice->id ?>">
                                                            <span class="fa fa-edit"></span>
                                                        </button>

                                                    </li>
                                                    <li>
                                                        <button class="delete notice" title="Remove notice" data-bs-toggle="tooltip" data-bs-placement="top" data-job-id="<?php echo $notice->id ?>">
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
        // Function to handle notice edit
        $('.edit-notice').on('click', function(e) {
            e.preventDefault();
            var noticeId = $(this).data('notice-id');

            // If user confirms editing, send AJAX request to edit the notice
            $.ajax({
                url: '<?php echo URLROOT . '/admin/editNotice/' ?>' + noticeId,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // If notice is edited successfully, show success message
                        Swal.fire(
                            'Saved Changes',
                            response.message,
                            'success'
                        ).then(() => {
                            // Reload the page after successful editing
                            location.reload();
                        });
                    } else {
                        // If editing fails, show error message
                        Swal.fire(
                            'Error!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error editing notice:", error);
                    // Show generic error message if AJAX request fails
                    Swal.fire(
                        'Error!',
                        'Failed to save changes',
                        'error'
                    );
                }
            });
        });

        // Function to handle click on "Edit Notice" button
        $('.edit-notice').on('click', function(e) {
            e.preventDefault();
            var noticeId = $(this).data('notice-id');
            // Redirect to the edit notice page
            window.location.href = '<?php echo URLROOT . '/admin/editnotice/' ?>' + noticeId;
        });

        // Function to handle notice deletion
        $('.delete-notice').on('click', function(e) {
            e.preventDefault();
            var noticeId = $(this).data('notice-id');

            // Show confirmation dialog using SweetAlert2
            Swal.fire({
                title: 'Confirm',
                text: 'Are you sure you want to delete this notice?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms deletion, send AJAX request to delete the notice
                    $.ajax({
                        url: '<?php echo URLROOT . '/admin/deleteNotice/' ?>' + noticeId,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                // If notice is deleted successfully, show success message
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
                            console.error("Error deleting notice:", error);
                            // Show generic error message if AJAX request fails
                            Swal.fire(
                                'Error!',
                                'Failed to delete notice. Please try again later.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>



<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>