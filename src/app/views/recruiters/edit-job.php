<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">
        <form action="<?php echo URLROOT; ?>/jobs/add" method="post" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-suitcase"></i>Job Details
                    </h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30">
                    <div class="row">
                        <!--Job title-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Job Title</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="topic" type="text" value="<?php echo $data['job']->topic ?>" placeholder="Artist" required />
                                    <i class="fs-input-icon fa fa-address-card"></i>
                                </div>
                            </div>
                        </div>
                        <!--Job Type-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Job Type</label>
                                <div class="ls-inputicon-box">
                                    <div class="">
                                        <select class="wt-select-box" name="type" data-live-search="true" title="" id="s-category" data-bv-field="size">
                                            <option <?php echo ($data['job']->type == 'Freelance') ? 'selected' : ''; ?>>Freelance</option>
                                            <option <?php echo ($data['job']->type == 'Internship') ? 'selected' : ''; ?>>Internship</option>
                                            <option <?php echo ($data['job']->type == 'Part-Time') ? 'selected' : ''; ?>>Part-Time</option>
                                            <option <?php echo ($data['job']->type == 'Volunteer') ? 'selected' : ''; ?>>Volunteer</option>
                                            <option <?php echo ($data['job']->type == 'Other') ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Job title-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Offered Salary</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="rate" type="text" placeholder="5000" value="<?php echo $data['job']->rate ?>" required />
                                    <i class="fs-input-icon fa fas fa-coins"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Salary Type</label>
                                <div class="ls-inputicon-box">
                                    <div class="">
                                        <select class="wt-select-box" name="rate_type" data-live-search="true" title="" id="s-category" data-bv-field="size">
                                            <option <?php echo ($data['job']->rate_type == 'One-Time') ? 'selected' : ''; ?>>One-Time</option>
                                            <option <?php echo ($data['job']->rate_type == 'Hour') ? 'selected' : ''; ?>>Hourly</option>
                                            <option <?php echo ($data['job']->rate_type == 'Week') ? 'selected' : ''; ?>>Weekly</option>
                                            <option <?php echo ($data['job']->rate_type == 'Month') ? 'selected' : ''; ?>>Monthly</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Website-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Website</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="website" type="text" placeholder="https://..." value="<?php echo $data['job']->website ?>" />
                                    <i class="fs-input-icon fa fa-globe-americas"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Keywords</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="keywords" type="text" placeholder="artist engineer..." id="hash-input" value="<?php echo $data['job']->keywords ?>" />
                                    <i class="fs-input-icon fa fa-hashtag"></i>
                                </div>
                            </div>
                        </div>
                        <!--Complete Address-->
                        <div class="col-xl-12 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Complete Address</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="location" type="text" placeholder="1363-1385 Sunset Blvd Los Angeles, CA 90026, USA" value="<?php echo $data['job']->location ?>" required />
                                    <i class="fs-input-icon fa fa-home"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <div class="custom-file">
                                    <label for="file-upload" class="custom-file-upload">
                                        <i class="fas fa-upload"></i> Banner Image
                                    </label>
                                    <input id="file-upload" type="file" name="banner_image" accept=".jpg, .jpeg, .png" />
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">

                            </div>
                        </div>
                    </div>

                    <!--Description-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="detail" rows="3" placeholder="Greetings! We are Galaxy Software Development Company. We hope you enjoy our services and quality." required><?php echo $data['job']->detail ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="text-left">
                            <button type="submit" class="site-button m-r5">
                                Publish Job
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Submit form data via AJAX when form is submitted
        $('form').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Display SweetAlert2 confirm dialog
            Swal.fire({
                title: 'Are you sure you want to update the job?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) { // If user confirms
                    var formData = new FormData($(this)[0]); // Get form data

                    $.ajax({
                        url: '<?php echo URLROOT; ?>/recruiters/editjob/<?php echo $data['job']->id ?>',
                        type: 'POST',
                        data: formData,
                        processData: false, // Prevent jQuery from automatically processing data
                        contentType: false, // Prevent jQuery from automatically setting contentType
                        success: function(response) {
                            if (response.status === 'success') {
                                // Handle successful response using SweetAlert2 with success icon
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success'
                                }).then(() => {
                                    window.location.href = '<?php echo URLROOT; ?>/recruiters/manage';
                                });
                            } else {
                                // Handle error response using SweetAlert2 with error icon
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error using SweetAlert2 with error message
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to update job. Please try again later.',
                                icon: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                            console.error("Error:", error);
                        }

                    });
                }
            });
        });
    });
</script>

<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>