<?php require APPROOT . '/views/inc/mod_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
  <div class="twm-right-section-panel site-bg-gray">
    <form action="<?php echo URLROOT; ?>/moderators/changepassword" method="post">
      <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
          <h4 class="panel-tittle m-a0">Change Password</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Old Password</label>
                <div class="ls-inputicon-box">
                  <input class="form-control wt-form-control" name="old_password" type="password" placeholder="" />
                  <i class="fs-input-icon fa fa-asterisk"></i>
                  <div class="invalid-feedback">
                    <?php echo $data['old_password_err']; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>New Password</label>
                <div class="ls-inputicon-box">
                  <input class="form-control wt-form-control" name="new_password" type="password" placeholder="" />
                  <i class="fs-input-icon fa fa-asterisk"></i>
                  <div class="invalid-feedback">
                    <?php echo $data['new_password_err']; ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Confirm New Password</label>
                <div class="ls-inputicon-box">
                  <input class="form-control wt-form-control" name="confirm_password" type="password" placeholder="" />
                  <i class="fs-input-icon fa fa-asterisk"></i>
                  <div class="invalid-feedback">
                    <?php echo $data['confirm_password_err']; ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12">
              <div class="text-left">
                <button type="submit" class="site-button">
                  Save Changes
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>