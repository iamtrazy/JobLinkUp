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
                <input type="search" placeholder="Search Data...">
                <img src="images/search.png" alt="">
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Recruiter Id </th>
                        <th> Business Name </th>
                        <th> Documents </th>
                        <th> Date Applied </th>
                        <th> Payment Status </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['BR_details'] as $BR):?>
                    <tr>
                        <td> <?php echo $BR->recruiter_id?></td>
                        <td><?php echo $BR->business_name?></td>
                        <td> <button class="download-btn" role="button">Download</button> </td>
                        <td> <?php echo $BR->recruiter_id?> </td>
                        <td>
                            <p class="status  Rejected"> Rejected</p>
                        </td>
                        <td>
                        <div style="display: flex;">
                         <button class="approve-btn" role="button">Approve</button>
                         <button class="reject-btn" role="button">Reject</button> </div>
                        </td>
                    </tr>
                   <?php endforeach;?>
                </tbody>
            </table>
        </section>
    </main>
    </div>



    
    <div class="pagination-outer">
        <div class="pagination-style1">
            <ul class="pagination-list clearfix">
                <!-- Pagination links will be dynamically generated here -->
                
            </ul>
        </div>
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
                            recruiter_id:recruiterId,
                            job_id:jobId,
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
                            recruiter_id:recruiterId,
                            job_id:jobId,
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
    
   <script>const search = document.querySelector('.input-group input'),
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
<script src="<?php echo URLROOT ?>/js/moderators/pagination.js"></script>

    <?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>