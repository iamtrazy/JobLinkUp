<?php require APPROOT . '/views/inc/mod_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">

        <main class="table table-bordered" id="customersTable">
            <section class="table__header">
            </section>
            <section class="table__body table-bordered">
                <table>
                    <thead>
                        <tr>
                            <th> Job Id </th>
                            <th> Seeker Id </th>
                            <th> Recruiter Id </th>
                            <th> Reason </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['disputes'] as $dispute) : ?>
                            <tr>

                                <td><?php echo $dispute->job_id ?></td>
                                <td><?php echo $dispute->seeker_id ?></td>
                                <td><?php echo $dispute->recruiter_id ?></td>
                                <td><?php echo $dispute->reason ?></td>
                                <td>
                                    <div style="display: flex;">
                                        <!-- <button class="approve-btn" role="button">Approve</button> 
                        <button class="reject-btn" role="button">Reject</button>  -->


                                        <a href="#" class="approve-btn" data-recruiter-id="<?php echo $dispute->recruiter_id ?>" data-seeker-id="<?php echo $dispute->seeker_id ?>" data-job-id="<?php echo $dispute->job_id ?>><i class=" fas fa-check"></i> Accept</a>
                                        <a href="#" class="reject-btn" data-recruiter-id="<?php echo $dispute->recruiter_id ?>" data-seeker-id="<?php echo $dispute->recruiter_id ?>" data-job-id="<?php echo $dispute->job_id ?>><i class=" fas fa-times"></i> Reject</a>



                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>





                    </tbody>
                </table>
            </section>
        </main>
    </div>
</div>



<script>
    $(document).ready(function() {
        // Handle click event for accept button
        $('.approve-btn').on('click', function(e) {
            e.preventDefault();

            // $compoundKey = $jobId . "_" . $seekerId;
            // const compoundKey = $(this).data('compound-key');

            const seekerId = $(this).data('seeker-id');
            const jobId = $(this).data('job-id');
            const recruiterId = $(this).data('recruiter-id');


            // Display SweetAlert prompt
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to accept this dispute?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send API request to accept the application
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo URLROOT . '/moderators/acceptDispute'; ?>',
                        data: {
                            seeker_id: seekerId,
                            recruiter_id: recruiterId,
                            job_id: jobId,
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
                                text: 'Failed to accept dispute',
                                icon: 'error',
                            });
                        }
                    });
                }
            });
        });

        // Handle click event for reject button
        $('.reject-btn').on('click', function(e) {
            e.preventDefault();
            const seekerId = $(this).data('seeker-id');
            const jobId = $(this).data('job-id');
            const recruiterId = $(this).data('recruiter-id');

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
                        url: '<?php echo URLROOT . '/recruiters/rejectDispute'; ?>',
                        data: {
                            seeker_id: seekerId,
                            recruiter_id: recruiterId,
                            job_id: jobId,
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

<script>
    const search = document.querySelector('.input-group input'),
        table_rows = document.querySelectorAll('tbody tr'),
        table_headings = document.querySelectorAll('thead th');

    // 1. Searching for specific data of HTML table
    search.addEventListener('input', searchTable);

    function searchTable() {
        table_rows.forEach((row, i) => {
            let table_data = row.textContent.toLowerCase(),
                search_data = search.value.toLowerCase();

            row.classList.toggle('hide', table_data.indexOf(search_data) < 0);
            row.style.setProperty('--delay', i / 25 + 's');
        })

        document.querySelectorAll('tbody tr:not(.hide)').forEach((visible_row, i) => {
            visible_row.style.backgroundColor = (i % 2 == 0) ? 'transparent' : '#0000000b';
        });
    }
</script>


<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>





<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>