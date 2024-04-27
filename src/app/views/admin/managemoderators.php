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
            <td><button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button></td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="<?php echo URLROOT ?>/js/admin/dashboard.js"></script>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>