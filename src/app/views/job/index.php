<?php require APPROOT . '/views/inc/seeker_header.php'; ?>
<div class="col-lg-8 col-md-12">
  <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
    <span class="woocommerce-result-count-left">Showing <?php echo count($data['jobs']) ?> jobs</span>
  </div>

  <div class="row">
    <?php foreach ($data['jobs'] as $job) : ?>
      <div class="col-lg-6 col-md-12 m-b30">
        <div class="twm-jobs-grid-style1">
          <div class="twm-media">
            <img src="<?php echo URLROOT?>/img/pic1.jpg" alt="#" />
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
            <a href="<?php echo URLROOT ?>/jobs/wishlist/<?php echo $job->id ?>">
              <button type="button">
                <i class="fas fa-cart-plus"></i>
              </button>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>