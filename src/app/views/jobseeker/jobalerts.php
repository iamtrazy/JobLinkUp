<?php require APPROOT . '/views/inc/seeker_header.php';
?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
  <div class="twm-right-section-panel candidate-save-job site-bg-gray">
    <div class="product-filter-wrap d-flex justify-content-between align-items-center">
      <span class="woocommerce-result-count-left">Job Alerts</span>
    </div>
    <div class="table-responsive">
      <table class="table twm-table table-striped table-borderless">
        <thead>
          <tr>
            <th>Title</th>
            <th>Jobs Location</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['jobs'] as $job) : ?>
            <tr>
              <td><?php echo $job->topic ?></td>
              <td><?php echo $job->location ?></td>
              <td><?php echo time_elapsed_string($job->created_at) ?></td>
              <td>
                <a data-bs-toggle="modal" href="<?php echo URLROOT . '/jobs/detail/' . $job->id ?>" role="button" class="custom-toltip">
                  <span class="fa fa-eye"></span>
                  <span class="custom-toltip-block">View</span>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>