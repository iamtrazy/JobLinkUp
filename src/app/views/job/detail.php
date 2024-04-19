<?php
if (isset($_SESSION['user_id'])) {
    require APPROOT . '/views/inc/jobs_detail_header.php';
} elseif (isset($_SESSION['business_id'])) {
    require APPROOT . '/views/inc/recruiter_header.php';
} else {
    require APPROOT . '/views/inc/jobs_detail_header.php';
}
?>

<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="cabdidate-de-info">
            <div class="twm-job-self-wrap">
                <div class="twm-job-self-info">
                    <div class="twm-job-self-top">
                        <div class="twm-media-bg">
                            <img src="<?php echo URLROOT ?>/img/job_banner/<?php echo $data['job']->banner_img; ?>" alt="Job Banner">
                            <div class="twm-jobs-category green"><span class="twm-bg-green">New</span></div>
                        </div>
                        <div class="twm-mid-content">
                            <div class="twm-media">
                                <img src="<?php echo URLROOT ?>/img/pic1.jpg" alt="Profile Picture">
                            </div>
                            <h4 class="twm-job-title"><?php echo $data['job']->topic; ?> <span class="twm-job-post-duration">/ <?php echo getTimeDifference($data['job']->created_at); ?></span></h4>
                            <p class="twm-job-address"><i class="fas fa-map-marker-alt"></i><?php echo $data['job']->location; ?></p>
                            <div class="twm-job-self-mid">
                                <div class="twm-job-self-mid-left">
                                    <a href="<?php echo $data['job']->website; ?>" class="twm-job-websites site-text-primary"><?php echo $data['job']->website; ?></a>
                                    <div class="twm-jobs-amount">$<?php echo $data['job']->rate; ?> <span>/ <?php echo $data['job']->rate_type; ?></span></div>
                                </div>
                                <div class="twm-job-apllication-area">Application ends:
                                    <span class="twm-job-apllication-date">date</span>
                                </div>
                            </div>

                            <div class="twm-job-self-bottom">
                                <a class="site-button" data-bs-toggle="modal" href="#apply_job_popup" role="button">
                                    Apply Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="twm-s-title">Job Description:</h4>
            <p><?php echo $data['job']->detail; ?></p>
            <h4 class="twm-s-title">Share Profile</h4>
            <div class="twm-social-tags">
                <a href="javascript:void(0)" class="fb-clr">Facebook</a>
                <a href="javascript:void(0)" class="tw-clr">Twitter</a>
                <a href="javascript:void(0)" class="link-clr">Linkedin</a>
                <a href="javascript:void(0)" class="whats-clr">Whatsapp</a>
                <a href="javascript:void(0)" class="pinte-clr">Pinterest</a>
            </div>
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
                                <span class="twm-title">8160 Views</span>
                                <!-- You need to add dynamic data here -->
                            </li>
                            <li>
                                <i class="fas fa-file-signature"></i>
                                <span class="twm-title">6 Applicants</span>
                                <!-- You need to add dynamic data here -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>