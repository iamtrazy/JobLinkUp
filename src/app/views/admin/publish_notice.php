<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">
        <form action="<?php echo URLROOT; ?>/admin/publishNotice" method="post" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-suitcase"></i>Notice Title
                    </h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30">
                    <div class="row">
                        <!--Job title-->
                        
                       
                        
                        
                        <!--link-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Link to any reference</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="website" type="text" placeholder="https://..." />
                                    <i class="fs-input-icon fa fa-globe-americas"></i>
                                </div>
                            </div>
                        </div>
                      
                       
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <div class="custom-file">
                                    <label for="file-upload" class="custom-file-upload">
                                        <i class="fas fa-upload"></i> Banner Image
                                    </label>
                                    <input id="file-upload" type="file" name="banner_image" accept=".jpg, .jpeg, .png" />
                                </div>
                            </div>
                        </div>

                       
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <div class="custom-file">
                                    <label for="file-upload" class="custom-file-upload">
                                        <i class="fas fa-upload"></i> Expiry date
                                    </label>
                                    <input id="expiry_date" type="date" name="expiry_date"/>
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
                    <div class="col-lg-12 col-md-12">
                        <div class="text-left">
                            <button type="submit" class="site-button m-r5">
                                Publish Notice
                            </button>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>who can view</label>
                                <div class="ls-inputicon-box">
                                    <div class="">
                                        <select class="wt-select-box" name="type" data-live-search="true" title="" id="s-category" data-bv-field="size">
                                            <option>Seekers</option>
                                            <option>Recruiters</option>
                                            <option>Moderators</option>
                                            <option>All</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>