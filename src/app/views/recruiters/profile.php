<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">
        <form method="post" action="<?php echo URLROOT . '/recruiters/profile' ?>" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">Basic Informations</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Your Name</label>
                                <div class="ls-inputicon-box">
                                    <input id="username" class="form-control" name="name" type="text" placeholder="Devid Smith" minlength="2" maxlength="255" />
                                    <i class="fs-input-icon fa fa-user"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <div class="ls-inputicon-box">
                                    <input id="phone" class="form-control" name="phone_no" type="text" placeholder="07xxxxxxxx" minlength="10" maxlength="15">
                                    <i class="fs-input-icon fa fa-phone-alt"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="ls-inputicon-box">
                                    <input id="email" class="form-control" name="email" type="email" placeholder="Devid@example.com" disabled />
                                    <i class="fs-input-icon fas fa-at"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group city-outer-bx has-feedback">
                                <label>Age</label>
                                <div class="ls-inputicon-box">
                                    <input id="age" class="form-control" name="age" type="number" min="0" max="100" placeholder="Enter age" />
                                    <i class="fs-input-icon fa fa-child"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-group city-outer-bx has-feedback">
                                <label>Full Address</label>
                                <div class="ls-inputicon-box">
                                    <input id="address" class="form-control" name="address" type="text" placeholder="1363-1385 Sunset Blvd Angeles, CA 90026 ,USA" minlength="10" maxlength="255" />
                                    <i class="fs-input-icon fas fa-map-marker-alt"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="profile-upload" class="custom-profile-upload">
                                    <i class="fas fa-upload"></i> Profile Image
                                </label>
                                <input id="profile-upload" type="file" name="profile_image" accept=".jpg, .jpeg, .png" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="text-left">
                            <button type="submit" class="site-button">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>

<script>
    $(document).ready(function() {
        // AJAX request to fetch job seeker details
        $.ajax({
            url: "<?php echo URLROOT; ?>/api/recruiter_profile/<?php echo $_SESSION['business_id']; ?>",
            method: "GET",
            dataType: "json",
            success: function(response) {
                // Populate form fields with fetched data
                $('#username').val(response.name);
                $('#email').val(response.email);
                $('#phone').val(response.phone_no);
                $('#age').val(response.age === 0 ? '' : response.age); // If age is zero, leave the field empty
                $('#address').val(response.address);
                // You can populate other form fields in a similar manner
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Handle error
            }
        });
    });
</script>