<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>
<div class="col-lg-8 col-md-12">
    <div class="twm-candidates-grid-wrap">
        <?php foreach ($data['applications'] as $application) : ?>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="twm-candidates-grid-style1 mb-5">
                        <div class="twm-mid-content">
                            <a href="candidate-detail.html" class="twm-job-title">
                                <h4> <img src="<?php echo URLROOT . '/img/profile/' . $application->profile_image ?>" alt="profile_image"> </h4>
                            </a>
                            <p><?php echo $application->username; ?></p>
                            <a href="candidate-detail.html" class="twm-view-prifile site-text-primary">View Profile</a>
                            <div class="twm-fot-content">
                                <div class="twm-left-info">
                                    <p class="twm-candidate-address"><i class="fas fa-map-marker-alt"></i><?php echo $application->address; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>