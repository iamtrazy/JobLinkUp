<?php require APPROOT . '/views/inc/admin_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
  <!--Filter Short By-->
  <div class="twm-right-section-panel site-bg-gray">

    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Hello <?php echo ucfirst($_SESSION['admin_name']) ?>!</h1>
        <br>
      </div>

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Full Name</th>
            <th scope="col">ID</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['moderators'] as $moderators): ?>
          <tr>
            <th scope="row">1</th>
            <td><?php echo $moderators-> name ?> </td>
            <td><?php echo $moderators-> id ?></td>
            <!-- <td><button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button></td> -->
            <td><button class="delete-moderator" title="Remove moderator" data-bs-toggle="tooltip" data-bs-placement="top" data-moderator-id="<?php echo $moderators->id ?>">
                                                            <span class="far fa-trash-alt"></span>
                                                        </button>
          </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        // Function to handle job deletion
        $('.delete-moderator').on('click', function(e) {
            e.preventDefault();
            var moderatorId = $(this).data('moderator-id');

            // Show confirmation dialog using SweetAlert2
            Swal.fire({
                title: 'Are you sure you want to delete this moderator?',
                text: 'this action can not be undone',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms deletion, send AJAX request to delete the moderator
                    $.ajax({
                        url: '<?php echo URLROOT . '/admin/deleteModerator/' ?>' + moderatorId,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                // If moderator is deleted successfully, show success message
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    // Reload the page after successful deletion
                                    location.reload();
                                });
                            } else {
                                // If deletion fails, show error message
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error deleting job:", error);
                            // Show generic error message if AJAX request fails
                            Swal.fire(
                                'Error!',
                                'Failed to delete job. Please try again later.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

      
    });
</script>
<script src="<?php echo URLROOT ?>/js/admin/dashboard.js"></script>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>