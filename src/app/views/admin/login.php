<?php require APPROOT . '/views/inc/header_1.php'; ?>
<div class="section-full site-bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 col-lg-6 col-md-5 twm-log-reg-media-wrap">
                <div class="twm-log-reg-media">
                    <div class="twm-l-media">
                        <img src="<?php echo URLROOT ?>/img/login-bg.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-7">
                <div class="twm-log-reg-form-wrap">
                    <div class="twm-log-reg-logo-head">
                        <a href="<?php echo URLROOT ?>">
                            <img src="<?php echo URLROOT ?>/img/logo-dark.png" alt="" class="logo" />
                        </a>
                    </div>

                    <div class="twm-log-reg-inner">
                        <div class="twm-log-reg-head">
                            <div class="twm-log-reg-logo">
                                <span class="log-reg-form-title">Log In</span>
                            </div>
                        </div>
                        <div class="twm-tabs-style-2">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">

                                <!--Login Candidate-->
                                <li class="nav-item">
                                    <a href="<?php echo URLROOT . '/moderators'; ?>"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#twm-login-candidate" type="button">
                                            <i class="fas fa-user-tie"></i>Moderator
                                        </button>
                                    </a>
                                </li>
                                <!--Login Employer-->
                                <li class="nav-item">
                                    <a href="<?php echo URLROOT . '/admins'; ?>">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#twm-login-Employer" type="button">
                                            <i class="fas fa-building"></i>Admin
                                        </button>
                                    </a>
                                </li>
                            </ul>



                            <div class="tab-content" id="myTab2Content">
                                <div class="tab-pane fade active show" id="twm-login-Employer">
                                    <div class="row">
                                        <form action="<?php echo URLROOT; ?>/admins/login" method="post">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="login_email" type="email" class="form-control" placeholder="email" required />
                                                    <div class="invalid-feedback">
                                                        <?php echo $data['login_email_err']; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="login_password" type="password" class="form-control" placeholder="Password" required />
                                                    <div class="invalid-feedback">
                                                        <?php echo $data['login_password_err']; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="site-button">
                                                        Log in
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>