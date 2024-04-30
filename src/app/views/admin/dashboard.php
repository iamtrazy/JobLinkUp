<?php require APPROOT . '/views/inc/admin_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray snipcss-1mHrn">
        <div class="wt-admin-right-page-header">
            <h1 class="display-4">Hello <?php echo ucfirst($_SESSION['admin_name']) ?>!</h1>
            <p class="lead">Welcome to the Admin Dashboard</p>
        </div>
        <div class="twm-dash-b-blocks mb-5">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 mb-3">
                    <div class="panel panel-default">
                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient">
                            <div class="wt-card-wrap-2">
                                <div class="wt-card-icon-2">
                                    <i class="fa fa-briefcase"></i>
                                </div>
                                <div class="value wt-card-right wt-total-active-listing counter" akhi="69">
                                    <?php echo $data['total_jobs'] ?>
                                </div>
                                <div class="wt-card-bottom-2 ">
                                    <h4 class="m-b0">Jobs</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 mb-3">
                    <div class="panel panel-default">
                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-2">
                            <div class="wt-card-wrap-2">
                                <div class="wt-card-icon-2">
                                <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="value wt-card-right wt-total-active-listing counter" akhi="69">
                                    <?php echo $data['total_recruiters'] ?>
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Recruiters</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 mb-3">
                    <div class="panel panel-default">
                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-3">
                            <div class="wt-card-wrap-2">
                                <div class="wt-card-icon-2">
                                <i class="fas fa-users"></i>
                                </div>
                                <div class="value wt-card-right wt-total-active-listing counter" akhi="69">
                                    <?php echo $data['total_jobseekers'] ?>
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Job Seekers</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 mb-3">
                    <div class="panel panel-default">
                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-4">
                            <div class="wt-card-wrap-2">
                                <div class="wt-card-icon-2">
                                <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="value wt-card-right wt-total-active-listing counter" akhi="69">
                                    <?php echo $data['total_income'] ?>
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Varified</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo URLROOT ?>/js/admin/dashboard.js"></script>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>