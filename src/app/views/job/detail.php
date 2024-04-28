<?php
if (isset($_SESSION['user_id'])) {
    require APPROOT . '/views/inc/jobs_detail_header.php';
} elseif (isset($_SESSION['business_id'])) {
    require APPROOT . '/views/inc/jobs_detail_header.php';
} else {
    require APPROOT . '/views/inc/jobs_detail_header.php';
}

?>



<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="cabdidate-de-info">
            <!-- Report Form Popup -->
            <div id="reportFormPopup" class="report-form-popup">
                <form id="reportForm" class="report-form" action="#" method="post">
                    <h2>Report Job</h2>
                    <!-- Hidden input for job ID -->
                    <input type="hidden" id="jobId" name="job_id" value="<?php echo $data['job']->id; ?>">
                    <label for="reason">Select Reason:</label>
                    <select id="reason" name="reason">
                        <option value="inappropriate">Inappropriate content</option>
                        <option value="spam">Spam</option>
                        <option value="misleading">Misleading information</option>
                        <option value="other">Other</option>
                    </select>
                    <div id="otherReason" style="display: none;">
                        <label for="otherReasonInput">Other Reason:</label>
                        <input type="text" id="otherReasonInput" name="otherReason">
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>



            <div class="twm-job-self-wrap">
                <div class="twm-job-self-info">
                    <div class="twm-job-self-top">
                        <div class="twm-media-bg">
                            <img src="<?php echo URLROOT ?>/img/job_banner/<?php echo $data['job']->banner_img; ?>" alt="Job Banner">
                            <?php
                            // Assuming time_elapsed_string function is defined somewhere

                            $time_elapsed = time_elapsed_string($data['job']->created_at);

                            if ($data['job']->is_varified == 1) {
                                echo '<div class="twm-jobs-category blue"><span class="twm-bg-green">Verified</span></div>';
                            }

                            if ((strpos($time_elapsed, 'hours') !== false || $time_elapsed === 'now') && $data['job']->is_varified != 1) {
                                echo '<div class="twm-jobs-category green"><span class="twm-bg-green">New</span></div>';
                            }
                            ?>

                        </div>
                        <div class="twm-mid-content">
                            <div class="twm-media">
                                <img src="<?php echo URLROOT . '/img/profile/' . $data['job']->profile_image ?>" alt="Profile Picture">
                            </div>
                            <p class="twm-job-address"><i class="fas fa-building"></i>
                                <?php
                                if ($data['job']->is_varified == 1) {
                                    echo $data['job']->business_name; // Display business name if is_varified is 1
                                } else {
                                    echo $data['job']->recruiter_name; // Display recruiter name otherwise
                                }
                                ?>
                            </p>

                            <h4 class="twm-job-title"><?php echo $data['job']->topic; ?> <span class="twm-job-post-duration">/ <?php echo time_elapsed_string($data['job']->created_at); ?></span></h4>
                            <p class="twm-job-address"><i class="fas fa-map-marker-alt"></i><?php echo $data['job']->location; ?></p>
                            <div class="twm-job-self-mid">
                                <div class="twm-job-self-mid-left">
                                    <a href="https://<?php echo $data['job']->website; ?>" class="twm-job-websites site-text-primary"><?php echo $data['job']->website; ?></a>
                                    <div class="twm-jobs-amount">LKR <?php echo $data['job']->rate; ?> <span>/ <?php echo $data['job']->rate_type; ?></span></div>
                                </div>
                                <div class="twm-job-apllication-area">Application ends:
                                    <span class="twm-job-apllication-date"><?php echo $data['job']->expire_in; ?></span>
                                </div>
                            </div>

                            <div class="twm-job-self-bottom">
                                <a class="site-button" data-bs-toggle="modal" href="<?php echo URLROOT . '/jobs/apply/' . $data['job']->id ?>" role="button">
                                    Apply Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="twm-s-title">Job Description:</h4>
            <p><?php echo $data['job']->detail; ?></p>
            <h4 class="twm-s-title">Share Job</h4>
            <div class="twm-social-tags">
                <a href="#" class="fb-clr">Facebook</a>
                <a href="#" class="tw-clr">Twitter</a>
                <a href="#" class="link-clr">Linkedin</a>
                <a href="#" class="pinte-clr">Pinterest</a>
            </div>
            <!-- Moderator Actions Container -->
            <?php if (isset($_SESSION['moderator_id'])) : ?>
                <div class="moderator-actions-container mt-4" style="border: 2px solid #dc3545; border-radius: 20px; padding: 10px; box-shadow: 0 0 10px rgba(220, 53, 69, 0.5); margin-top: 30px;">
                    <h4 style="margin-bottom: 10px;">Moderator Actions</h4>
                    <div class="moderator-actions">
                        <?php if ($data['job']->is_deleted == 0) : ?>
                            <button class="btn btn-danger animate-on-click disable-job-btn" style="border-radius: 30px; padding: 8px 20px; font-size: 16px; background-color: #dc3545; color: #fff;"><i class="fas fa-ban"></i> Disable Job</button>
                        <?php else : ?>
                            <button class="btn btn-success animate-on-click enable-job-btn" style="border-radius: 30px; padding: 8px 20px; font-size: 16px; background-color: #28a745; color: #fff;"><i class="fas fa-undo"></i> Restore Job</button>
                        <?php endif; ?>
                        <button class="btn btn-warning ml-2 animate-on-click" style="border-radius: 30px; padding: 8px 20px; font-size: 16px; background-color: #ffc107; color: #212529;" id="reportToAdmin"><i class="fas fa-exclamation-triangle"></i> Report to Admin</button>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
    <div class="col-lg-4 col-md-12 rightSidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
        <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
            <div class="side-bar mb-4">
                <div class="twm-s-info2-wrap mb-5">
                    <div class="twm-s-info2">
                        <h4 class="section-head-small mb-4">Job Information</h4>
                        <ul class="twm-job-hilites">
                            <li>
                                <i class="fas fa-calendar-alt"></i>
                                <span class="twm-title">Date Posted: </span>
                                <span><?php echo explode(' ', $data['job']->created_at)[0]; ?></span>
                            </li>
                            <li>
                                <i class="fas fa-eye"></i>
                                <span class="twm-title"><?php echo $data['job']->view_count ?> Views</span>
                                <!-- You need to add dynamic data here -->
                            </li>
                            <li>
                                <i class="fas fa-file-signature"></i>
                                <span class="twm-title"><?php echo $data['appliedCount']->count . '  Applicants' ?></span>
                                <!-- You need to add dynamic data here -->
                            </li>
                            <li>
                                <!-- Report Button -->
                                <a href="#" class="report-button" role="button">
                                    <i class="fas fa-exclamation-triangle"></i> Report
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {


        var reportButton = $(".report-button");
        var reportFormPopup = $("#reportFormPopup");
        var overlay = $("<div class='overlay'></div>");
        $("body").append(overlay);

        reportButton.on("click", function(event) {
            event.preventDefault();
            reportFormPopup.show();
            overlay.show();
        });

        // Close report form popup when clicking outside the popup
        overlay.on("click", function() {
            reportFormPopup.hide();
            overlay.hide();
        });

        // Show/hide 'Other Reason' input based on selected reason
        $("#reason").on("change", function() {
            if ($(this).val() === "other") {
                $("#otherReason").show();
            } else {
                $("#otherReason").hide();
            }
        });

        // Handle form submission using AJAX
        $("#reportForm").on("submit", function(event) {
            event.preventDefault();

            // Serialize form data
            var formData = new FormData($(this)[0]);

            // Send AJAX request
            $.ajax({
                type: "POST",
                url: "<?php echo URLROOT; ?>/jobs/report",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Parse JSON response
                    var jsonResponse = JSON.parse(response);
                    // Show response using SweetAlert
                    Swal.fire({
                        icon: jsonResponse.error ? 'error' : 'success',
                        title: jsonResponse.error,
                        timer: 3000, // Adjust the timer as needed
                        showConfirmButton: false
                    }).then(() => {
                        // Close popup and overlay
                        reportFormPopup.hide();
                        overlay.hide();
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                    // Show error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: "Error",
                        text: "Unable to process your request. Please try again later.",
                        timer: 3000, // Adjust the timer as needed
                        showConfirmButton: false
                    });
                }
            });
        });

        $(".twm-social-tags a").on("click", function(event) {
            event.preventDefault();
            var socialNetwork = $(this).text().toLowerCase();
            var url = window.location.href;
            var shareUrl = "";

            // Define share URL based on social network
            switch (socialNetwork) {
                case "facebook":
                    shareUrl = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url);
                    break;
                case "twitter":
                    shareUrl = "https://twitter.com/intent/tweet?url=" + encodeURIComponent(url);
                    break;
                case "linkedin":
                    shareUrl = "https://www.linkedin.com/shareArticle?url=" + encodeURIComponent(url);
                    break;
                case "pinterest":
                    shareUrl = "https://pinterest.com/pin/create/button/?url=" + encodeURIComponent(url);
                    break;
                default:
                    break;
            }

            // Open share URL in a new window
            if (shareUrl !== "") {
                window.open(shareUrl, '_blank');
            }
        });
    });
</script>

<?php if (isset($_SESSION['moderator_id'])) : ?>
    <script>
        $(document).ready(function() {
            // Disable Job Button
            $(".disable-job-btn").click(function() {
                // Confirm the action using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to disable this job!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, disable it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send POST request to disable job
                        $.post('<?php echo URLROOT . '/moderators/disable_job' ?>', {
                            job_id: <?php echo $data['job']->id ?>
                        }).done(function(data) {
                            // Check for success or error message
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Job Disabled',
                                    text: data.message,
                                    icon: 'success'
                                }).then(() => {
                                    // Reload the page
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        }).fail(function() {
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to disable job. Please try again later.',
                                icon: 'error'
                            });
                        });
                    }
                });
            });

            // Report Job to Admin Button
            $("#reportToAdmin").click(function() {
                // Confirm the action using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to report this job to the admin!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc107',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, report it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send POST request to report job to admin
                        $.post('<?php echo URLROOT . '/moderators/report_job_admin' ?>', {
                            job_id: <?php echo $data['job']->id ?>
                        }).done(function(data) {
                            // Check for success or error message
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Job Reported',
                                    text: data.message,
                                    icon: 'success'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        }).fail(function() {
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to report job. Please try again later.',
                                icon: 'error'
                            });
                        });
                    }
                });
            });
            // Enable Job Button
            $(".enable-job-btn").click(function() {
                // Confirm the action using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to restore this job!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, restore it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send POST request to enable job
                        $.post('<?php echo URLROOT . '/moderators/enable_job' ?>', {
                            job_id: <?php echo $data['job']->id ?>
                        }).done(function(data) {
                            // Check for success or error message
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Job Restored',
                                    text: data.message,
                                    icon: 'success'
                                }).then(() => {
                                    // Reload the page
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        }).fail(function() {
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to restore job. Please try again later.',
                                icon: 'error'
                            });
                        });
                    }
                });
            });

            // Report Job Button
            $(".report-job-btn").click(function() {
                // Open report form popup
                $("#reportFormPopup").show();
                $(".overlay").show();
            });
        });
    </script>
<?php endif; ?>


<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>