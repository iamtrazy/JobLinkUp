<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>
<div class="col-lg-8 col-md-12 my-section-2">
    <!--Filter Short By-->
    <div class="product-filter-wrap justify-content-between align-items-right m-b30">
        <span class="woocommerce-result-count-left" style="float: right;">Showing <?php echo count($data['applications']) ?> Candidates</span>
    </div>
    <div class="twm-candidates-list-wrap">
        <ul>
            <?php foreach ($data['applications'] as $application) : ?>
                <div class="twm-candidates-list-style1 mb-5">
                    <div class="twm-media">
                        <div class="twm-media-pic">
                            <img src="<?php echo URLROOT . '/img/profile/' . $application->profile_image ?>" alt="#">
                        </div>
                        <?php $time_elapsed = time_elapsed_string($application->created_at);

                        if (strpos($time_elapsed, 'hours') !== false || strpos($time_elapsed, 'hour') !== false || strpos($time_elapsed, 'now') !== false) {
                            echo '
                        <div class="twm-candidates-tag"><span>New Candidate</span></div>';
                        } ?>
                    </div>
                    <div class="twm-mid-content">
                        <a href="candidate-detail.html" class="twm-job-title">
                            <h4> <?php echo $application->username ?> </h4>
                        </a>
                        <p><?php echo $application->email ?></p>
                        <div class="twm-fot-content">
                            <div class="twm-left-info">
                                <p class="twm-candidate-address"><i class="fas fa-map-marker-alt"></i><?php echo $application->address ?></p>
                                <div class="twm-jobs-vacancies"><span><?php echo 'Applied ' . time_elapsed_string($application->created_at) ?></span></div>
                            </div>
                            <div class="twm-right-btn">
                                <a href="candidate-detail.html" class="twm-view-prifile site-text-primary">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

</div>


<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>