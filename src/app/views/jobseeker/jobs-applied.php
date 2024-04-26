<?php
function getStatusColor($status)
{
  switch ($status) {
    case 'pending':
      return 'yellow';
    case 'approved':
      return 'lightgreen';
    case 'rejected':
      return 'red';
    default:
      return 'grey';
  }
}

function getStatusText($status)
{
  switch ($status) {
    case 'pending':
      return 'Pending';
    case 'approved':
      return 'Accepted';
    case 'rejected':
      return 'Rejected';
    default:
      return 'Unknown';
  }
}
?>

<?php require APPROOT . '/views/inc/seeker_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
  <div class="twm-right-section-panel candidate-save-job site-bg-gray">
    <div class="product-filter-wrap d-flex justify-content-between align-items-center">
      <span class="woocommerce-result-count-left">Applied <?php echo $data['applied_count'] ?> jobs</span>

      <form class="woocommerce-ordering twm-filter-select" method="get">
        <span class="woocommerce-result-count">Sort By</span>

        <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="category">
          <option>Most Recent</option>
          <option>Category</option>
          <option>Price</option>
        </select>

      </form>
    </div>

    <div class="twm-jobs-list-wrap">
      <ul>
        <?php foreach ($data['application'] as $application) : ?>
          <li>
            <div class="twm-jobs-list-style1 mb-5">
              <div class="twm-media">
                <img src="../../img/pic1.jpg" alt="#" />
              </div>
              <div class="twm-mid-content">
                <div class="twm-job-title">
                  <h4>
                    <?php echo $application->topic ?><span class="twm-job-post-duration"><?php echo ' / Applied ' . time_elapsed_string($application->created_at) ?></span>
                  </h4>
                </div>
                <p class="twm-job-address">
                  <?php echo $application->location ?>
                </p>
                <span class="status-label" style="background-color: <?php echo getStatusColor($application->status); ?>">
                  <?php echo getStatusText($application->status); ?>
                </span>
              </div>
              <div class="twm-right-content">
                <?php
                // Assuming time_elapsed_string function is defined somewhere

                $time_elapsed = time_elapsed_string($application->created_at);

                if (strpos($time_elapsed, 'hours') !== false || strpos($time_elapsed, 'hour') !== false || strpos($time_elapsed, 'minutes') !== false || strpos($time_elapsed, 'minute') !== false || strpos($time_elapsed, 'now') !== false) {
                  echo '                <div class="twm-jobs-category green">  
                                <span class="twm-bg-green">New</span>
                                </div>';
                }
                ?>
                <div class="twm-jobs-amount">
                  LKR <?php echo $application->rate ?> <span>/ <?php echo $application->rate_type ?></span>
                </div>
                <a href="<?php echo URLROOT ?>/jobs/detail/<?php echo $application->id; ?>" class="twm-jobs-browse site-text-primary">Job Details</a>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>