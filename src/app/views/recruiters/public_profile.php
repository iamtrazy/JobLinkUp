<?php
if (isset($_SESSION['user_id'])) {
    require APPROOT . '/views/inc/candidate_profile_header.php';
} elseif (isset($_SESSION['business_id'])) {
    require APPROOT . '/views/inc/candidate_profile_header.php';
} else {
    require APPROOT . '/views/inc/candidate_profile_header.php';
}
?>

<?php
$city = $data['profile']->city == "unknown" ? "" : $data['profile']->city;
$country = $data['profile']->country == "unknown" ? "" : $data['profile']->country;
$address = "";

if (!empty($city) && !empty($country)) {
    $address = $city . ", " . $country;
} elseif (!empty($city)) {
    $address = $city;
} elseif (!empty($country)) {
    $address = $country;
} else {
    $address = "Unknown";
}
?>

<div class="row d-flex justify-content-center">
    <div class="col-lg-8 col-md-12">
        <div class="cabdidate-de-info">
            <div class="twm-candi-self-wrap overlay-wraper" style="background-image:url(<?php echo URLROOT ?>/img/profile/candidate-bg.jpg);">
                <div class="overlay-main site-bg-primary opacity-01"></div>
                <div class="twm-candi-self-info">
                    <div class="twm-candi-self-top">
                        <div class="twm-media">
                            <img src="<?php echo URLROOT . '/img/profile/' . $data['profile']->profile_image ?>" alt="#">
                        </div>
                        <div class="twm-mid-content">
                            <h4 class="twm-job-title"><?php echo $data['profile']->name ?></h4>
                            <p class="twm-candidate-address"><i class="fas fa-map-marker-alt"></i><?php echo $address ?></p>
                        </div>
                    </div>
                    <div class="twm-candi-self-bottom">
                        <!-- WhatsApp button -->
                        <?php if (isset($data['profile']->whatsapp_url)) : ?>
                            <a href="https://wa.me/<?php echo $data['profile']->whatsapp_url ?>" class="site-button outline-white" style="background-color: #25D366; color: #fff;">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        <?php endif; ?>
                        <?php if (isset($data['profile']->linkedin_url)) : ?>
                            <a href="https://<?php echo $data['profile']->linkedin_url ?>" class="site-button outline-white" style="background-color: #0077B5; color: #fff;">
                                <i class="fab fa-linkedin"></i> LinkedIn
                            </a>
                        <?php endif; ?>
                        <!-- Email button -->
                        <?php if (isset($data['profile']->email)) : ?>
                            <a href="mailto:<?php echo $data['profile']->email ?>" class="site-button outline-white" style="background-color: #FFA500; color: #fff;">
                                <i class="far fa-envelope"></i> Email
                            </a>
                        <?php endif; ?>
                        <!-- Phone button -->
                        <?php if (isset($data['profile']->phone_no)) : ?>
                            <a href="tel:<?php echo $data['profile']->phone_no ?>" class="site-button outline-white" style="background-color: #bd56fc; color: #fff;">
                                <i class="fas fa-phone"></i> Phone
                            </a>
                        <?php endif; ?>
                        <!-- Download CV button -->
                        <?php if (isset($data['profile']->cv)) : ?>
                            <a href="<?php echo URLROOT . '/assets/cvs/' . $data['profile']->cv ?> " target="_blank" class="site-button secondry outline-white">Download CV</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <h4 class="twm-s-title">About Me</h4>
            <?php if (isset($data['profile']->about)) {
                echo '<p>' . $data['profile']->about . '</p>';
            } else {
                echo 'No details found';
            } ?>

            <!-- Moderator Actions -->
            <?php if (isset($_SESSION['moderator_id']) || isset($_SESSION['admin_id'])) : ?>
                <div class="moderator-actions-container mt-4" style="border: 2px solid #dc3545; border-radius: 20px; padding: 10px; box-shadow: 0 0 10px rgba(220, 53, 69, 0.5); margin-top:50px">
                    <h4 style="margin-bottom: 10px;">Moderator Actions</h4>
                    <?php if ($data['profile']->is_banned) : ?>
                        <div class="alert alert-warning" role="alert">
                            This account is disabled.
                        </div>
                        <button class="btn btn-success enable-btn" style="border-radius: 30px; padding: 8px 20px; font-size: 16px; background-color: #039e27; color: #fff;">
                            <i class="fas fa-user-check"></i> Enable Account
                        </button>
                    <?php else : ?>
                        <button class="btn btn-danger disable-btn animate-on-click" style="border-radius: 30px; padding: 8px 20px; font-size: 16px; background-color: #dc3545; color: #fff;"><i class="fas fa-user-slash"></i> Disable Account</button>
                    <?php endif; ?>
                    <button class="btn btn-warning ml-2 animate-on-click" style="border-radius: 30px; padding: 8px 20px; font-size: 16px; background-color: #ffc107; color: #212529;" id="reportToAdmin"><i class="fas fa-exclamation-triangle"></i> Report to Admin</button>
                </div>
            <?php endif; ?>

        </div>
    </div>
    <div class="col-lg-4 col-md-12 rightSidebar">
        <div class="side-bar-2">
            <?php if ($address !== 'Unknown') : ?>
                <div class="twm-s-map mb-5">
                    <h4 class="section-head-small mb-4">Location</h4>
                    <div class="twm-s-map-iframe">
                        <iframe height="270" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.8534521658976!2d-118.2533646842856!3d34.073270780600225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c6fd9829c6f3%3A0x6ecd11bcf4b0c23a!2s<?= urlencode($address) ?>!5e0!3m2!1sen!2sin"></iframe>
                    </div>
                </div>
            <?php endif; ?>
            <div class="twm-s-info-wrap mb-5">
                <h4 class="section-head-small mb-4">Profile Info</h4>
                <div class="twm-s-info">
                    <ul>
                        <li>
                            <?php if (isset($data['profile']->phone_no)) : ?>
                                <div class="twm-s-info-inner">
                                    <i class="fas fa-mobile-alt"></i>
                                    <span class="twm-title">Phone</span>
                                    <div class="twm-s-info-discription"><?php echo $data['profile']->phone_no ?></div>
                                </div>
                            <?php endif; ?>
                        </li>
                        <li>
                            <div class="twm-s-info-inner">
                                <i class="fas fa-at"></i>
                                <span class="twm-title">Email</span>
                                <div class="twm-s-info-discription"><?php echo $data['profile']->email ?></div>
                            </div>
                        </li>
                        <li>
                            <div class="twm-s-info-inner">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="twm-title">Location</span>
                                <div class="twm-s-info-discription"><?php echo $address ?></div>
                            </div>
                        </li>
                        <?php if (isset($data['profile']->website)) : ?>
                            <li>
                                <div class="twm-s-info-inner">
                                    <i class="fas fa-globe"></i>
                                    <span class="twm-title">Website</sepan>
                                        <div class="twm-s-info-discription"><?php echo '<a href="https://' . $data['profile']->website . ' class="site-text-primary"> Visit </a>' ?> </div>
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if (isset($data['profile']->age)) : ?>
                            <li>
                                <div class="twm-s-info-inner">
                                    <i class="fas fa-birthday-cake"></i>
                                    <span class="twm-title">Age</span>
                                    <div class="twm-s-info-discription"><?php echo $data['profile']->age ?></div>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        <?php if (isset($_SESSION['moderator_id'])) : ?>
            // Moderator is logged in, enable moderator actions
            // Disable Account Button
            $('.disable-btn').click(function() {
                // Confirm the action using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to disable this recruiter's account!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, disable it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send POST request to disable recruiter
                        $.post('<?php echo URLROOT . '/moderators/disable_recruiter' ?>', {
                            recruiter_id: <?php echo $data['profile']->id ?> // Assuming the recruiter ID is accessible here
                        }).done(function(data) {
                            // Check for success or error message
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Recruiter Disabled',
                                    text: data.message,
                                    icon: 'success'
                                }).then(() => {
                                    // Redirect to /moderators/disputes
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
                            // Error handling for failed AJAX request
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to disable recruiter. Please try again later.',
                                icon: 'error'
                            });
                        });
                    }
                });
            });

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
                        $.post('<?php echo URLROOT . '/moderators/report_recruiter_admin' ?>', {
                            recruiter_id: <?php echo $data['profile']->id ?>
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

            // Enable Account Button
            $('.enable-btn').click(function() {
                // Confirm the action using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to enable this recruiter's account!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, enable it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send POST request to enable recruiter
                        $.post('<?php echo URLROOT . '/moderators/enable_recruiter' ?>', {
                            recruiter_id: <?php echo $data['profile']->id ?> // Assuming the recruiter ID is accessible here
                        }).done(function(data) {
                            // Check for success or error message
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Recruiter Enabled',
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
                            // Error handling for failed AJAX request
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to enable recruiter. Please try again later.',
                                icon: 'error'
                            });
                        });
                    }
                });
            });
        <?php endif; ?>
    });
</script>

<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>