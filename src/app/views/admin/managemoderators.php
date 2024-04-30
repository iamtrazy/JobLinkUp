<?php require APPROOT . '/views/inc/admin_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
  <!--Filter Short By-->
  <div class="twm-right-section-panel site-bg-gray">
    <main class="table table-bordered" id="customersTable">
      <section class="table__body table-bordered">
        <main class="table" id="customersTable">
          <section class="table__header">
            <div class="input-group">
              <input id="searchInput" type="search" placeholder="Search Data...">
              <img src="images/search.png" alt="">
            </div>
          </section>
          <section class="table__body table-bordered">
            <table>
              <thead>
                <tr>
                  <th> Moderator Name </th>
                  <th> Email </th>
                  <th> Last Active </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['moderators'] as $moderator) : ?>
                  <tr class="table-row">
                    <td> <?php echo $moderator->name ?></td>
                    <td><?php echo $moderator->email ?></td>
                    <td><?php echo time_elapsed_string($moderator->last_active) ?></td>
                    <td>
                      <?php if ($moderator->is_disabled == 1) : ?>
                        <button class="enable-btn" style="background-color: #069433; color: white; padding: 5px 10px; border-radius: 20px;" data-moderator-id="<?php echo $moderator->id; ?>">Enable</button>
                      <?php else : ?>
                        <button class="disable-btn" style="background-color: #e62b1e; color: white; padding: 5px 10px; border-radius: 20px;" data-moderator-id="<?php echo $moderator->id; ?>">Disable</button>
                      <?php endif; ?>
                    </td>
                    <!-- <td>
                      <?php if ($transaction->paid == 1) : ?>
                        <p style="background-color: #007bff; color: white; padding: 5px 10px; border-radius: 20px;">Paid</p>
                      <?php elseif ($transaction->br_uploaded == 1) : ?>
                        <p style="background-color: #d9b518; color: white; padding: 5px 10px; border-radius: 20px;">Payment Pending</p>
                      <?php endif; ?>
                    </td> -->
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </section>
        </main>
      </section>
    </main>
  </div>
</div>
<script>
  $(document).ready(function() {
    // Event listener for clicking the disable button
    $(".disable-btn").click(function() {
      // Get the moderator ID from the data attribute
      var moderatorId = $(this).data('moderator-id');

      // Confirm the action using SweetAlert
      Swal.fire({
        title: 'Are you sure?',
        text: "You are about to disable this moderator!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, disable it!'
      }).then((result) => {
        if (result.isConfirmed) {
          // Send POST request to disable moderator
          $.post('/admins/disable_moderator', {
            moderator_id: moderatorId
          }).done(function(data) {
            // Check for success or error message
            if (data.status === 'success') {
              Swal.fire({
                title: 'Moderator Disabled',
                text: data.message,
                icon: 'success'
              }).then(() => {
                // Reload the page or perform any other action
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
            Swal.fire({
              title: 'Error',
              text: 'Failed to disable moderator. Please try again later.',
              icon: 'error'
            });
          });
        }
      });
    });

    // Event listener for clicking the enable button
    $(".enable-btn").click(function() {
      // Get the moderator ID from the data attribute
      var moderatorId = $(this).data('moderator-id');

      // Confirm the action using SweetAlert
      Swal.fire({
        title: 'Are you sure?',
        text: "You are about to enable this moderator!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, enable it!'
      }).then((result) => {
        if (result.isConfirmed) {
          // Send POST request to enable moderator
          $.post('/admins/enable_moderator', {
            moderator_id: moderatorId
          }).done(function(data) {
            // Check for success or error message
            if (data.status === 'success') {
              Swal.fire({
                title: 'Moderator Enabled',
                text: data.message,
                icon: 'success'
              }).then(() => {
                // Reload the page or perform any other action
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
            Swal.fire({
              title: 'Error',
              text: 'Failed to enable moderator. Please try again later.',
              icon: 'error'
            });
          });
        }
      });
    });
  });
</script>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>