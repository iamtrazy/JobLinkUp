<?php require APPROOT . '/views/inc/admin_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">
        <form action="<?php echo URLROOT; ?>/admins/addadmin" method="post">
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-user-plus"></i>Add Moderator
                    </h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30">
                    <!-- Moderator Name -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Moderator Name</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="name" type="text" placeholder="John Doe" required />
                                    <i class="fs-input-icon fa fa-user"></i>
                                    <div class="invalid-feedback">
                                        <?php echo $data['name_err']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Moderator Email -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Moderator Email</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="email" type="email" placeholder="example@example.com" required />
                                    <i class="fs-input-icon fa fa-envelope"></i>
                                    <div class="invalid-feedback">
                                        <?php echo $data['email_err']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Moderator Password -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="password" type="password" placeholder="Password" required />
                                    <i class="fs-input-icon fa fa-lock"></i>
                                    <div class="invalid-feedback">
                                        <?php echo $data['password_err']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="confirm_password" type="password" placeholder="Confirm Password" required />
                                    <i class="fs-input-icon fa fa-lock"></i>
                                    <div class="invalid-feedback">
                                        <?php echo $data['confirm_password_err']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" class="site-button m-r5">
                                    Add Moderator
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>