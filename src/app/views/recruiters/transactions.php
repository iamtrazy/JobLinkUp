<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">
        <form action="<?php echo URLROOT; ?>/recruiters/applyForBR" method="post" enctype="multipart/form-data">
                <?php echo flash('registerBR_success'); ?>
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-suitcase"></i>Business Details
                    </h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30">
                    <div class="row">
                        <!--Job title-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Business name</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="name" type="text" placeholder="Business name" required />
                                    <i class="fs-input-icon fa fa-address-card"></i>
                                </div>
                            </div>
                        </div>
                        <!--Job Type-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Job Type</label>
                                <div class="ls-inputicon-box">
                                    <div class="">
                                        <select class="wt-select-box" name="type" data-live-search="true" title="" id="s-category" data-bv-field="size">
                                            <option>Freelance</option>
                                            <option>Internship</option>
                                            <option>Part-Time</option>
                                            <option>Volunteer</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Job title-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Offered Salary</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="rate" type="text" placeholder="5000" value="<?php echo $data['salary']; ?>" />
                                    <i class="fs-input-icon fa fas fa-coins"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Salary Type</label>
                                <div class="ls-inputicon-box">
                                    <div class="">
                                        <select class="wt-select-box" name="rate_type" data-live-search="true" title="" id="s-category" data-bv-field="size">
                                            <option>One-Time</option>
                                            <option>Hourly</option>
                                            <option>Weekly</option>
                                            <option>Monthly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Website-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Website</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="website" type="text" placeholder="https://..." />
                                    <i class="fs-input-icon fa fa-globe-americas"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Keywords</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="keywords" type="text" placeholder="artist engineer..." id="hash-input" />
                                    <i class="fs-input-icon fa fa-hashtag"></i>
                                </div>
                            </div>
                        </div>
                        <!--Complete Address-->
                        <div class="col-xl-12 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Complete Address</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="location" type="text" placeholder="1363-1385 Sunset Blvd Los Angeles, CA 90026, USA" required />
                                    <i class="fs-input-icon fa fa-home"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Banner Image</label>
                                <div class="input-group">
                                    <input type="file" name="banner_image" id="file-uploader" accept=".jpg, .jpeg, .png">
                                </div>
                            </div>
                        </div>
                    </div>


    
                    <!--Description-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="detail" rows="3" placeholder="Greetings! We are Galaxy Software Development Company. We hope you enjoy our services and quality." required></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Upload Payment Receipt</label>
                            <div class="input-group">
                                    <input type="file" name="payment_receipt" id="file-uploader" accept=".jpg, .jpeg, .png .pdf">
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="text-left">
                            <button type="submit" class="site-button m-r5">
                                Apply for BR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>
</div>
<script src="<?php echo URLROOT ?>/js/jobs/hashtags.js"></script>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>