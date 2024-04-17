<?php require APPROOT . '/views/inc/mod_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <!--Filter Short By-->
    <div class="twm-right-section-panel site-bg-gray">
        <div class="wt-admin-right-page-header">
            <h2><?php echo $_SESSION['moderator_name'] ?></h2>
            <p></p>
        </div>

        <div class="twm-dash-b-blocks mb-5">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                    <div class="panel panel-default">
                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient">
                            <div class="wt-card-wrap-2">
                                <div class="wt-card-icon-2">
                                    <i class="fa fa-briefcase"></i>
                                </div>
                                <div class="wt-card-right wt-total-active-listing counter">
                                    3
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Posted Jobs</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                    <div class="panel panel-default">
                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-2">
                            <div class="wt-card-wrap-2">
                                <div class="wt-card-icon-2">
                                    <i class="fa fa-tasks"></i>
                                </div>
                                <div class="wt-card-right wt-total-listing-view counter">
                                    10
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Pending Applications</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                    <div class="panel panel-default">
                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-3">
                            <div class="wt-card-wrap-2">
                                <div class="wt-card-icon-2">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="wt-card-right wt-total-listing-review counter">
                                    28
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Messages</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                    <div class="panel panel-default">
                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-4">
                            <div class="wt-card-wrap-2">
                                <div class="wt-card-icon-2">
                                    <i class="fa fa-bell"></i>
                                </div>
                                <div class="wt-card-right wt-total-listing-bookmarked counter">
                                    18
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Notifications</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>