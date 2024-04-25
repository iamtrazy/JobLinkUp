<?php require APPROOT . '/views/inc/explore_header.php'; ?>


<div class="col-lg-8 col-md-12">
    <!--Filter Short By-->
    <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
        <span class="woocommerce-result-count-left">Showing 2,150 Recruiters</span>

        <form class="woocommerce-ordering twm-filter-select" method="get">
            <span class="woocommerce-result-count">Short By</span>
            <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                <option>Most Recent</option>
                <option>Freelance</option>
                <option>Full Time</option>
                <option>Internship</option>
                <option>Part Time</option>
                <option>Temporary</option>
            </select>
            <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                <option>Show 10</option>
                <option>Show 20</option>
                <option>Show 30</option>
                <option>Show 40</option>
                <option>Show 50</option>
                <option>Show 60</option>
            </select>
        </form>

    </div>

    <div class="twm-candidates-grid-wrap">
        <div class="row">
            <!-- <div class="col-lg-6 col-md-6">
                <div class="twm-candidates-grid-style1 mb-5">
                    <div class="twm-media">
                        <div class="twm-media-pic">
                            <img src="images/candidates/pic1.jpg" alt="#">
                        </div>
                        <div class="twm-candidates-tag"><span>Featured</span></div>
                    </div>
                    <div class="twm-mid-content">
                        <a href="candidate-detail.html" class="twm-job-title">
                            <h4>Wanda Montgomery </h4>
                        </a>
                        <p>Charted Accountant</p>
                        <a href="candidate-detail.html" class="twm-view-prifile site-text-primary">View Profile</a>

                        <div class="twm-fot-content">
                            <div class="twm-left-info">
                                <p class="twm-candidate-address"><i class="feather-map-pin"></i>New York</p>
                                <div class="twm-jobs-vacancies">$20<span>/ Day</span></div>
                            </div>

                        </div>
                    </div>

                </div>
            </div> -->

            <?php foreach ($data['all_recruiters'] as $recruiter) : ?>
                <div class="col-lg-6 col-md-6">
                    <div class="twm-candidates-grid-style1 mb-5">
                        <div class="twm-media">
                            <div class="twm-media-pic">
                                <img src="<?php echo URLROOT ?>/img/pic4.jpg" alt="">
                            </div>
                        </div>
                        <div class="twm-mid-content">
                            <a href="candidate-detail.html" class="twm-job-title">
                                <h4> <?php echo $recruiter->name; ?> </h4>
                            </a>
                            <div class="mid-mid-content">
                                <a href="candidate-detail.html" class="twm-view-prifile site-text-primary">View Business Profile</a>
                                <a href="candidate-detail.html" class="twm-download-resume site-text-primary">Resume</a>
                            </div>
                            <div class="twm-fot-content">
                                <div class="twm-left-info">
                                    <p class="twm-candidate-address"><i class="fa-solid fa-location-dot"></i>malabe</p>
                                    <div class="twm-jobs-vacancies"><?php echo $recruiter->job_count?> Recruitments </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>



        </div>
    </div>

    <div class="pagination-outer">
        <div class="pagination-style1">
            <ul class="clearfix">
                <li class="prev"><a href="javascript:;"><span> <i class="fa fa-angle-left"></i> </span></a></li>
                <li><a href="javascript:;">1</a></li>
                <li class="active"><a href="javascript:;">2</a></li>
                <li><a href="javascript:;">3</a></li>
                <li><a class="javascript:;" href="javascript:;"><i class="fa fa-ellipsis-h"></i></a></li>
                <li><a href="javascript:;">5</a></li>
                <li class="next"><a href="javascript:;"><span> <i class="fa fa-angle-right"></i> </span></a></li>
            </ul>
        </div>
    </div>

</div>

<?php require APPROOT . '/views/inc/explore_footer.php'; ?>