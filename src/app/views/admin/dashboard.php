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
                                    3
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
                                    <i class="fa fa-tasks"></i>
                                </div>
                                <div class="value wt-card-right wt-total-active-listing counter" akhi="69">
                                    3
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Tasks</h4>
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
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="value wt-card-right wt-total-active-listing counter" akhi="69">
                                    3
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Messages</h4>
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
                                    <i class="fa fa-bell"></i>
                                </div>
                                <div class="value wt-card-right wt-total-active-listing counter" akhi="69">
                                    3
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Notifications</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 mb-3">
                    <div class="panel panel-default site-bg-white">
                        <div class="panel-heading wt-panel-heading p-a20">
                            <h4 class="panel-tittle m-a0"><i class="far fa-chart-bar"></i>Number of Users</h4>
                        </div>
                        <div class="panel-body wt-panel-body twm-pro-view-chart">
                            <canvas id="myChart2" width="916" height="457" class="style-UT8kA"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 mb-3">
                    <div class="panel panel-default site-bg-white">
                        <div class="panel-heading wt-panel-heading p-a20">
                            <h4 class="panel-tittle m-a0"><i class="far fa-chart-bar"></i>User Activity</h4>
                        </div>
                        <div class="panel-body wt-panel-body twm-pro-view-chart">
                            <canvas id="myChart3" width="916" height="457" class="style-UT8kA"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="twm-pro-view-chart-wrap">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                <div class="panel panel-default site-bg-white">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0"><i class="far fa-chart-bar"></i>Number of Users per Quarter</h4>
                    </div>
                    <div class="panel-body wt-panel-body twm-pro-view-chart">
                        <canvas id="myChart" width="916" height="457" class="style-UT8kA"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Inbox</h4>
                    </div>
                    <div class="panel-body wt-panel-body bg-white">
                        <div class="scroll-wrapper dashboard-messages-box-scroll scrollbar-macosx style-8dZk3" id="style-8dZk3">
                            <div class="dashboard-messages-box-scroll scrollbar-macosx scroll-content scroll-scrolly_visible style-Fo8Pv" id="style-Fo8Pv">
                                <div class="dashboard-messages-box">
                                    <div class="dashboard-message-avtar"><img src="https://thewebmax.org/jobzilla/images/user-avtar/pic1.jpg" alt=""></div>
                                    <div class="dashboard-message-area">
                                        <h5>Lucy Smith<span>18 June 2023</span></h5>
                                        <p>Bring to the table win-win survival strategies to ensure proactive domination. at the end of the day, going forward, a new normal that has evolved from generation.</p>
                                    </div>
                                </div>
                                <div class="dashboard-messages-box">
                                    <div class="dashboard-message-avtar"><img src="https://thewebmax.org/jobzilla/images/user-avtar/pic3.jpg" alt=""></div>
                                    <div class="dashboard-message-area">
                                        <h5>Richred paul<span>19 June 2023</span></h5>
                                        <p>Bring to the table win-win survival strategies to ensure proactive domination. at the end of the day, going forward, a new normal that has evolved from generation.</p>
                                    </div>
                                </div>
                                <div class="dashboard-messages-box">
                                    <div class="dashboard-message-avtar"><img src="https://thewebmax.org/jobzilla/images/user-avtar/pic4.jpg" alt=""></div>
                                    <div class="dashboard-message-area">
                                        <h5>Jon Doe<span>20 June 2023</span></h5>
                                        <p>Bring to the table win-win survival strategies to ensure proactive domination. at the end of the day, going forward, a new normal that has evolved from generation.</p>
                                    </div>
                                </div>
                                <div class="dashboard-messages-box">
                                    <div class="dashboard-message-avtar"><img src="https://thewebmax.org/jobzilla/images/user-avtar/pic1.jpg" alt=""></div>
                                    <div class="dashboard-message-area">
                                        <h5>Thomas Smith<span>22 June 2023</span></h5>
                                        <p>Bring to the table win-win survival strategies to ensure proactive domination. at the end of the day, going forward, a new normal that has evolved from generation. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="scroll-element scroll-x scroll-scrolly_visible">
                                <div class="scroll-element_outer">
                                    <div class="scroll-element_size"></div>
                                    <div class="scroll-element_track"></div>
                                    <div class="scroll-bar style-oDe8C" id="style-oDe8C"></div>
                                </div>
                            </div>
                            <div class="scroll-element scroll-y scroll-scrolly_visible">
                                <div class="scroll-element_outer">
                                    <div class="scroll-element_size"></div>
                                    <div class="scroll-element_track"></div>
                                    <div class="scroll-bar style-xgaSn" id="style-xgaSn"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="panel panel-default site-bg-white m-t30">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0"><i class="far fa-list-alt"></i>Recent Activities</h4>
                    </div>
                    <div class="panel-body wt-panel-body">
                        <div class="dashboard-list-box list-box-with-icon">
                            <ul>
                                <li>
                                    <i class="fa fa-envelope text-success list-box-icon"></i>Nikol Tesla has sent you <a href="#" class="text-success">private message!</a>
                                    <a href="#" class="close-list-item color-lebel clr-red">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-suitcase text-primary list-box-icon"></i>Your job for <a href="#" class="text-primary">Web Designer</a> has been approved! <a href="#" class="close-list-item color-lebel clr-red">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-bookmark text-warning list-box-icon"></i> Someone bookmarked your <a href="#" class="text-warning">SEO Expert</a> Job listing! <a href="#" class="close-list-item color-lebel clr-red">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-tasks text-info list-box-icon"></i> Your job listing Core <a href="#" class="text-info">PHP Developer</a> for Site Maintenance is expiring! <a href="#" class="close-list-item color-lebel clr-red">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-paperclip text-success list-box-icon"></i> You have new application for <a href="#" class="text-success"> UI/UX Developer &amp; Designer! </a>
                                    <a href="#" class="close-list-item color-lebel clr-red">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-suitcase text-danger list-box-icon"></i> Your Magento Developer job expire <a href="#" class="text-danger">Renew</a> now it. <a href="#" class="close-list-item color-lebel clr-red">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-star site-text-orange list-box-icon"></i> David cope left a <a href="#" class="site-text-orange"> review 4.5</a> for Real Estate Logo <a href="#" class="close-list-item color-lebel clr-red">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Recent Applicants</h4>
                    </div>
                    <div class="panel-body wt-panel-body bg-white">
                        <div class="twm-dashboard-candidates-wrap">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="twm-dash-candidates-list">
                                        <div class="twm-media">
                                            <div class="twm-media-pic">
                                                <img src="https://thewebmax.org/jobzilla/images/candidates/pic1.jpg" alt="#">
                                            </div>
                                        </div>
                                        <div class="twm-mid-content">
                                            <a href="#" class="twm-job-title">
                                                <h4>Wanda Montgomery </h4>
                                            </a>
                                            <p>Charted Accountant</p>
                                            <div class="twm-fot-content">
                                                <div class="twm-left-info">
                                                    <p class="twm-candidate-address"><i class="fa fa-map-marker"></i>New York</p>
                                                    <div class="twm-jobs-vacancies">$20<span>/ Day</span></div>
                                                </div>
                                                <div class="twm-right-btn">
                                                    <ul class="twm-controls-icon list-unstyled">
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View profile" fdprocessedid="vjl89">
                                                                <span class="fa fa-eye"></span>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Send message" fdprocessedid="88dd4">
                                                                <span class="far fa-envelope-open"></span>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" fdprocessedid="g1wj6">
                                                                <span class="far fa-trash-alt"></span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="twm-dash-candidates-list">
                                        <div class="twm-media">
                                            <div class="twm-media-pic">
                                                <img src="https://thewebmax.org/jobzilla/images/candidates/pic2.jpg" alt="#">
                                            </div>
                                        </div>
                                        <div class="twm-mid-content">
                                            <a href="#" class="twm-job-title">
                                                <h4>Peter Hawkins</h4>
                                            </a>
                                            <p>Medical Professed</p>
                                            <div class="twm-fot-content">
                                                <div class="twm-left-info">
                                                    <p class="twm-candidate-address"><i class="fa fa-map-marker"></i>New York</p>
                                                    <div class="twm-jobs-vacancies">$7<span>/ Hour</span></div>
                                                </div>
                                                <div class="twm-right-btn">
                                                    <ul class="twm-controls-icon list-unstyled">
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View profile" fdprocessedid="endjwcd">
                                                                <span class="fa fa-eye"></span>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Send message" fdprocessedid="dhhqil">
                                                                <span class="far fa-envelope-open"></span>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" fdprocessedid="thohjt">
                                                                <span class="far fa-trash-alt"></span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="twm-dash-candidates-list">
                                        <div class="twm-media">
                                            <div class="twm-media-pic">
                                                <img src="https://thewebmax.org/jobzilla/images/candidates/pic3.jpg" alt="#">
                                            </div>
                                        </div>
                                        <div class="twm-mid-content">
                                            <a href="#" class="twm-job-title">
                                                <h4>Ralph Johnson </h4>
                                            </a>
                                            <p>Bank Manger</p>
                                            <div class="twm-fot-content">
                                                <div class="twm-left-info">
                                                    <p class="twm-candidate-address"><i class="fa fa-map-marker"></i>New York</p>
                                                    <div class="twm-jobs-vacancies">$180<span>/ Day</span></div>
                                                </div>
                                                <div class="twm-right-btn">
                                                    <ul class="twm-controls-icon list-unstyled">
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View profile" fdprocessedid="g8xqnv">
                                                                <span class="fa fa-eye"></span>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Send message" fdprocessedid="jw5sl">
                                                                <span class="far fa-envelope-open"></span>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" fdprocessedid="6srohj">
                                                                <span class="far fa-trash-alt"></span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="twm-dash-candidates-list">
                                        <div class="twm-media">
                                            <div class="twm-media-pic">
                                                <img src="https://thewebmax.org/jobzilla/images/candidates/pic4.jpg" alt="#">
                                            </div>
                                        </div>
                                        <div class="twm-mid-content">
                                            <a href="#" class="twm-job-title">
                                                <h4>Randall Henderson </h4>
                                            </a>
                                            <p>IT Contractor</p>
                                            <div class="twm-fot-content">
                                                <div class="twm-left-info">
                                                    <p class="twm-candidate-address"><i class="fa fa-map-marker"></i>New York</p>
                                                    <div class="twm-jobs-vacancies">$90<span>/ Week</span></div>
                                                </div>
                                                <div class="twm-right-btn">
                                                    <ul class="twm-controls-icon list-unstyled">
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View profile" fdprocessedid="lccorh">
                                                                <span class="fa fa-eye"></span>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Send message" fdprocessedid="047im8">
                                                                <span class="far fa-envelope-open"></span>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" fdprocessedid="asz8ls">
                                                                <span class="far fa-trash-alt"></span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="twm-dash-candidates-list">
                                        <div class="twm-media">
                                            <div class="twm-media-pic">
                                                <img src="https://thewebmax.org/jobzilla/images/candidates/pic6.jpg" alt="#">
                                            </div>
                                        </div>
                                        <div class="twm-mid-content">
                                            <a href="#" class="twm-job-title">
                                                <h4>Christina Fischer </h4>
                                            </a>
                                            <p>Charity &amp; Voluntary</p>
                                            <div class="twm-fot-content">
                                                <div class="twm-left-info">
                                                    <p class="twm-candidate-address"><i class="fa fa-location-arrow"></i>New York</p>
                                                    <div class="twm-jobs-vacancies">$19<span>/ Hour</span></div>
                                                </div>
                                                <div class="twm-right-btn">
                                                    <ul class="twm-controls-icon list-unstyled">
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View profile" fdprocessedid="rr70q">
                                                                <span class="fa fa-eye"></span>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Send message" fdprocessedid="6l49n">
                                                                <span class="far fa-envelope-open"></span>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" fdprocessedid="rk41a5">
                                                                <span class="far fa-trash-alt"></span>
                                                            </button>
                                                        </li>
                                                    </ul>
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
        </div>
    </div>
</div>
<!-- table to manage moderators -->
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Full Name</th>
            <th scope="col">Role</th>
            <th scope="col">Last Activity</th>
            <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark Otto</td>
            <td>Moderator L1</td>
            <td>Few minutes Ago</td>
            <td>
                <button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i>
                </button>
                <button type="button" class="btn btn-outline-primary"><i class="fa fa-fingerprint"></i></button>
            </td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>Mark Otto</td>
            <td>Moderator L1</td>
            <td>Few minutes Ago</td>
            <td>
                <button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i>
                </button>
                <button type="button" class="btn btn-outline-primary"><i class="fa fa-fingerprint"></i></button>
            </td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>Mark Otto</td>
            <td>Moderator L1</td>
            <td>Few minutes Ago</td>
            <td>
                <button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i>
                </button>
                <button type="button" class="btn btn-outline-primary"><i class="fa fa-fingerprint"></i></button>
            </td>
        </tr>
    </tbody>
</table>



<!-- manage ads -->
<div class="col-lg-12 col-md-12 mb-4">
    <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">Advertisement Review</h4>
        </div>
        <div class="panel-body wt-panel-body bg-white">
            <div class="twm-dashboard-candidates-wrap">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="twm-dash-candidates-list mb-3">
                            <div class="twm-media">
                                <div class="twm-media-pic">
                                    <img src="https://thewebmax.org/jobzilla/images/jobs-company/pic1.jpg" alt="#">
                                </div>
                            </div>
                            <div class="twm-mid-content">
                                <a href="#" class="twm-job-title">
                                    <h4>Senior Web Designer</h4>
                                </a>
                                <p>1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                <div class="twm-fot-content">
                                    <div class="twm-left-info">
                                        <p class="twm-candidate-address"><i class="fa fa-map-marker"></i>New York</p>
                                        <div class="twm-jobs-vacancies">$20<span>/ Day</span></div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-success"><i class="fa fa-fingerprint"></i></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="twm-dash-candidates-list mb-3">
                            <div class="twm-media">
                                <div class="twm-media-pic">
                                    <img src="https://thewebmax.org/jobzilla/images/jobs-company/pic1.jpg" alt="#">
                                </div>
                            </div>
                            <div class="twm-mid-content">
                                <a href="#" class="twm-job-title">
                                    <h4>Senior Web Designer</h4>
                                </a>
                                <p>1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                <div class="twm-fot-content">
                                    <div class="twm-left-info">
                                        <p class="twm-candidate-address"><i class="fa fa-map-marker"></i>New York</p>
                                        <div class="twm-jobs-vacancies">$20<span>/ Day</span></div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-success"><i class="fa fa-fingerprint"></i></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="twm-dash-candidates-list mb-3">
                            <div class="twm-media">
                                <div class="twm-media-pic">
                                    <img src="https://thewebmax.org/jobzilla/images/jobs-company/pic1.jpg" alt="#">
                                </div>
                            </div>
                            <div class="twm-mid-content">
                                <a href="#" class="twm-job-title">
                                    <h4>Senior Web Designer</h4>
                                </a>
                                <p>1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                <div class="twm-fot-content">
                                    <div class="twm-left-info">
                                        <p class="twm-candidate-address"><i class="fa fa-map-marker"></i>New York</p>
                                        <div class="twm-jobs-vacancies">$20<span>/ Day</span></div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-success"><i class="fa fa-fingerprint"></i></button>
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

<!-- Backup -->

<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="jumbotron">
        <h1 class="display-4">Hello, <?php echo ucfirst($_SESSION['admin_name']) ?>!</h1>
        <p class="lead">This page will allow you to take backups, the last backup was made on the 24th of February 2024.</p>
        <hr class="my-4">
        <p>Please choose a backup method</p>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="backup" id="daily" value="option1" checked>
            <label class="form-check-label" for="daily">
                Daily
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="backup" id="weekly" value="option2">
            <label class="form-check-label" for="weekly">
                Weekly
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="backup" id="monthly" value="option3">
            <label class="form-check-label" for="monthly">
                Monthly
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="backup" id="manual" value="option4">
            <label class="form-check-label" for="manual">
                Manual
            </label>
        </div>

        <br>

        <button type="button" id="auto" class="btn btn-success">
            Save changes
        </button>

        <button type="button" id="manual-backup" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="display:none;">
            Backup Now
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Please confirm to replace the last backup.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Backup Now</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="alert" class="alert alert-success" role="alert" style="display:none;">
    Your changes have been saved successfullly
</div>


<script>
    const ctx = document.getElementById('myChart');
    const ctx2 = document.getElementById('myChart2');
    const ctx3 = document.getElementById('myChart3');

    const data = {
        labels: [
            'Job Seekers',
            'Job Recruiters',
            'Moderators'
        ],
        datasets: [{
            label: 'Users',
            data: [300, 50, 100],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['First', 'Second', 'Third', 'Fourth'],
            datasets: [{
                label: 'number of Users per Quarter',
                data: [12, 19, 3, 5],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(54, 162, 235)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    new Chart(ctx2, {
        type: 'doughnut',
        data: data,
    });

    new Chart(ctx3, {
        type: 'radar',
        data: {
            labels: [
                'Applied',
                'Pending',
                'Saved',
                'Recruited',
                'Logins',
                'Premium Bought'
            ],
            datasets: [{
                label: 'Recruiters',
                data: [65, 59, 90, 81, 56, 55],
                fill: true,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgb(255, 99, 132)',
                pointBackgroundColor: 'rgb(255, 99, 132)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(255, 99, 132)'
            }, {
                label: 'Seekers',
                data: [28, 48, 40, 19, 96, 27],
                fill: true,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgb(54, 162, 235)',
                pointBackgroundColor: 'rgb(54, 162, 235)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(54, 162, 235)'
            }]
        },
        options: {
            elements: {
                line: {
                    borderWidth: 3
                }
            }
        },

    });



    const counters = document.querySelectorAll('.value');
    const speed = 200;

    counters.forEach(counter => {
        const animate = () => {
            const value = +counter.getAttribute('akhi');
            const data = +counter.innerText;

            const time = value / speed;
            if (data < value) {
                counter.innerText = Math.ceil(data + time);
                setTimeout(animate, 1);
            } else {
                counter.innerText = value;
            }

        }

        animate();
    });

    const box = document.getElementById('manual-backup');
    const save = document.getElementById('auto');
    const alert = document.getElementById('alert');

    function handleRadioClick() {
        if (document.getElementById('manual').checked) {
            box.style.display = 'block';
            save.style.display = 'none';
        } else {
            box.style.display = 'none';
            save.style.display = 'block';
        }
    }

    function saveChanges() {
        alert.style.display = 'block';
        setTimeout(close, 3000)
    };

    function close() {
        alert.style.display = 'none';
    };

    const radioButtons = document.querySelectorAll(
        'input[name="backup"]',
    );
    radioButtons.forEach(radio => {
        radio.addEventListener('click', handleRadioClick);
    });

    save.addEventListener('click', saveChanges);
</script>

<script src="<?php echo URLROOT ?>/js/admin/dashboard.js"></script>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>