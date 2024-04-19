<?php
foreach ($data['jobs'] as $job) : ?>
    <div class="col-lg-6 col-md-12 m-b30">
        <div class="twm-jobs-grid-style1" style="margin-bottom: 3%;">
            <div class="twm-media">
                <img src="<?php echo URLROOT ?>/img/pic1.jpg" alt="#" />
            </div>
            <span class="twm-job-post-duration"><?php echo time_elapsed_string($job->created_at); ?></span>
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
            <div class="twm-right-content" style="margin-top: 3%;">
                <div class="twm-jobs-amount">
                    LKR <?php echo $job->rate; ?> <span>/ Month</span>
                </div>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <button type="button" class="apply-now-btn">
                        <i class="fas fa-check-circle"></i> Apply Now !
                    </button>

                    <a href="<?php echo URLROOT ?>/jobs/wishlist/<?php echo $job->id; ?>">
                        <button type="button" class="wishlist-btn" ;>
                            <i class="fas fa-heart"></i>
                        </button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>