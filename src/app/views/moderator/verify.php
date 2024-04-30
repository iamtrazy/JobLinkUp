<?php require APPROOT . '/views/inc/mod_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">
        <main class="table table-bordered" id="customersTable">
            <section class="table__header">
            </section>
            <section class="table__body table-bordered">
                <main class="table" id="customersTable">
                    <section class="table__header">
                        <div class="input-group">
                            <input id="searchInput" type="search" placeholder="Search Data...">
                            <img src="images/search.png" alt="">
                        </div>
                    </section>
                    <section class="table__body">
                        <table id="recruiterTable">
                            <thead>
                                <tr>
                                    <th> Recruiter Name </th>
                                    <th> Business Name </th>
                                    <th> BR Document </th>
                                    <th> Date Applied </th>
                                    <th> Payment Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['BR_details'] as $BR) : ?>
                                    <tr class="table-row" data-url="<?php echo URLROOT . '/recruiters/public_profile/' . $BR->id ?>">
                                        <td> <?php echo $BR->name ?></td>
                                        <td><?php echo $BR->business_name ?></td>
                                        <td><a class="download-btn" role="button" href="<?php echo URLROOT . '/assets/brs/' . $BR->br_path ?>" target="_blank">Download</a> </td>
                                        <td><?php echo time_elapsed_string($BR->application_date) ?></td>
                                        <td>
                                            <?php if ($BR->paid == 1) : ?>
                                                <p style="background-color: #007bff; color: white; padding: 5px 10px; border-radius: 20px;">Paid</p>
                                            <?php else : ?>
                                                <p style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 20px;">Not Paid</p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($BR->is_varified == 1) : ?>
                                                <p style="background-color: #28a745; color: white; padding: 5px 10px; border-radius: 20px;">BR Approved</p>
                                            <?php else : ?>
                                                <div style="display: flex;">
                                                    <button class="approve-btn" role="button" data-recruiter-id="<?php echo $BR->id; ?>">Approve</button>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </section>
                </main>
            </section>
        </main>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Handle click event for table rows
        $('#recruiterTable').on('click', 'tr.table-row', function() {
            // Get URL from data attribute
            var url = $(this).data('url');
            // Redirect to the URL
            window.open(url, '_blank');
        });

        // Handle click event for approve and reject buttons
        $('.approve-btn, .reject-btn').on('click', function(e) {
            e.stopPropagation(); // Prevent event propagation to table rows
        });

        $('#searchInput').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('.approve-btn').on('click', function(e) {
            e.preventDefault(); // Prevent default button behavior
            const recruiterId = $(this).data('recruiter-id');

            // Display SweetAlert prompt
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to approve verification for this recruiter?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send API request to approve verification
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo URLROOT . '/moderators/approve_verification'; ?>',
                        data: {
                            recruiter_id: recruiterId
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
                                text: 'Failed to approve verification',
                                icon: 'error',
                            });
                        }
                    });
                }
            });
        });

        $('.reject-btn').on('click', function(e) {
            e.preventDefault(); // Prevent default button behavior
            const recruiterId = $(this).data('recruiter-id');

            // Display SweetAlert prompt
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to reject verification for this recruiter?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send API request to reject verification
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo URLROOT . '/moderators/reject_verification'; ?>',
                        data: {
                            recruiter_id: recruiterId
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
                                text: 'Failed to reject verification',
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