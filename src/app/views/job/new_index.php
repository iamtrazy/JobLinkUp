<?php
if (isset($_SESSION['user_id'])) {
    require APPROOT . '/views/inc/jobs_header.php';
} else
if (isset($_SESSION['business_id'])) {
    require APPROOT . '/views/inc/recruiter_header.php';
} else {
    require APPROOT . '/views/inc/guest_header_jobs.php';
}
?>
<div class="col-lg-8 col-md-12">
    <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
        <span class="woocommerce-result-count-left">Showing <?php echo count($data['jobs']) ?> jobs</span>
        <form class="woocommerce-ordering twm-filter-select" method="get">
            <span class="woocommerce-result-count">Sort By</span>
            
            <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                <option>Most Recent</option>
                <option>Freelance</option>
                <option>Full Time</option>
                <option>Internship</option>
                <option>Part Time</option>
                <option>Temporary</option>
            </select>
            <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                <option>Show 10</option>
                <option>Show 20</option>
                <option>Show 30</option>
                <option>Show 40</option>
                <option>Show 50</option>
                <option>Show 60</option>
            </select>
        </form>
    </div>
    <div class="row">
        <?php foreach ($data['jobs'] as $job) : ?>
            <div class="col-lg-6 col-md-12 m-b30">
                <div class="twm-jobs-grid-style1">
                    <div class="twm-media">
                        <img src="<?php echo URLROOT ?>/img/pic1.jpg" alt="#" />
                    </div>
                    <span class="twm-job-post-duration">1 days ago</span>
                    <div class="twm-jobs-category green">
                        <span class="twm-bg-green"><?php echo $job->type; ?></span>
                    </div>
                    <div class="twm-mid-content">
                        <a href="#" class="twm-job-title">
                            <h4><?php echo $job->topic; ?></h4>
                        </a>
                        <p class="twm-job-address">
                            <?php echo $job->location; ?>
                        </p>
                        <a href="#" class="twm-job-websites site-text-primary"><?php echo $job->website; ?></a>
                    </div>
                    <div class="twm-right-content">
                        <div class="twm-jobs-amount">
                            LKR <?php echo $job->rate; ?> <span>/ Month</span>
                        </div>
                        <?php if (isset($_SESSION['user_id'])) {
                            echo '
                                            <a href="' . URLROOT . '/jobs/wishlist/' . $job->id . '">
                                                <button type="button">
                                                <i class="fas fa-cart-plus"></i>
                                                </button>
                                            </a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>