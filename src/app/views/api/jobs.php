<?php foreach ($data['jobs'] as $job) : ?>
    <?php
    // Check if the job is verified
    $is_verified = $job->is_varified == 1;
    // Generate class names based on verification status
    $border_class = $is_verified ? 'blue-glowing-border' : '';
    $verified_button_class = $is_verified ? 'verified-button' : '';
    ?>
    <div class="col-lg-6 col-md-12 m-b30 <?php echo $border_class; ?>" style="cursor: pointer;">
        <div class="twm-jobs-grid-style1" data-jobid="<?php echo $job->id; ?>" style="margin-bottom: 3%;">
            <div class="twm-media">
                <img src="<?php echo URLROOT ?>/img/pic1.jpg" alt="#" />
            </div>
            <span class="twm-job-post-duration"><?php echo time_elapsed_string($job->created_at); ?></span>
            <div class="twm-jobs-category green">
                <span class="twm-bg-green"><?php echo $job->type; ?></span>
            </div>
            <div class="twm-mid-content">
                <a href="<?php echo URLROOT ?>/jobs/detail/<?php echo $job->id; ?>" class="twm-job-title">
                    <h4><?php echo $job->topic; ?></h4>
                </a>
                <p class="twm-job-address">
                    <?php echo $job->location; ?>
                </p>
                <a href="#" class="twm-job-websites site-text-primary"><?php echo $job->website; ?></a>
            </div>
            <?php if ($is_verified) : ?>
                <!-- Display verified button if the job is verified -->
                <div class="verified-button">
                    <i class="fas fa-check-circle"></i> Verified
                </div>
            <?php endif; ?>
            <div class="twm-right-content" style="margin-top: 3%;">
                <div class="twm-jobs-amount">
                    LKR <?php echo $job->rate; ?><?php if ($job->rate_type !== 'One-Time') echo ' <span>/ ' . $job->rate_type . '</span>'; ?>
                </div>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <button type="button" class="apply-now-btn" onclick="applyNow(<?php echo $job->id; ?>, event)">
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

<script>
    $(document).ready(function() {
        $('.twm-jobs-grid-style1').click(function() {
            var jobId = $(this).data('jobid');
            window.location.href = "<?php echo URLROOT ?>/jobs/detail/" + jobId;
        });
    });

    function applyNow(jobId, event) {
        // Prevent the click event from propagating to the parent div
        event.stopPropagation();
        window.location.href = "<?php echo URLROOT ?>/jobs/apply/" + jobId;
    }
</script>