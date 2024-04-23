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
                                    <input class="form-control" name="business_name" type="text" placeholder="Business name" required />
                                    <i class="fs-input-icon fa fa-address-card"></i>
                                </div>
                            </div>
                        </div>

                        <!--Job Type-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Business Type</label>
                                <div class="ls-inputicon-box">
                                    <div class="">
                                        <select class="wt-select-box" name="business_type" data-live-search="true" title="" id="s-category" data-bv-field="size">
                                            <option>Sole Proprietership</option>
                                            <option>Partnership</option>
                                            <option>co-operation</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!--Complete Address-->
                        <div class="col-xl-12 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Business Registration number</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="business_reg_no" type="text" placeholder="" required />
                                    <i class="fs-input-icon fa fa-home"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Business Address</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="business_address" type="text" placeholder="1363-1385 Sunset Blvd Los Angeles, CA 90026, USA" required />
                                    <i class="fs-input-icon fa fa-home"></i>
                                </div>
                            </div>
                        </div>

                    </div>


    
                    
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-suitcase"></i>Contact Information
                    </h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30">
                    <div class="row">
                        <!--Job title-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Contact person</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="contact_person" type="text" placeholder="contact person name" required="">
                                    <i class="fs-input-icon fa fa-address-card"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Contact Email</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="contact_email" type="text" placeholder="contact person name" required="">
                                    <i class="fs-input-icon fa fa-address-card"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Contact number</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control" name="contact_number" type="text" placeholder="contact person name" required="">
                                    <i class="fs-input-icon fa fa-address-card"></i>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        </div>
                    </div>

                    
                    </div>

            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-suitcase"></i>Uploads
                    </h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30">
                    <div class="row">
                        
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Upload Documents</label>
                                <div class="input-group">
                                    <input type="file" name="document" id="file-uploader" accept=".jpg, .jpeg, .png" class="">
                                </div>
                            </div>
                        </div>
                    </div>

                
</form>


                  
                    <div class="col-lg-12 col-md-12">
                        <div class="text-left">
                            <button type="submit" class="site-button m-r5 pay">
                                Pay
                            </button>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="site-button m-r5">
                                Upload BR documents here
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-suitcase"></i> Verification agreement
                    </h4>
                </div>
                <div class="panel-heading p-a20">
                <h4 class="panel-tittle ">
                         Terms and conditions
                </h4>
                </div>
                

                
                <div class="panel-body wt-panel-body p-a20 m-b30 terms_content">

<p><strong>Verification Process:</strong> The Recruiter agrees to undergo a verification process to confirm the business status on the <em>JobLinkUp</em> platform. This process may include providing necessary documentation and information as requested by the Company.</p>

<p><strong>Accuracy of Information:</strong> The Recruiter certifies that all information provided during the verification process is accurate, complete, and up-to-date to the best of their knowledge. Any false or misleading information provided may result in the rejection of the verification application and may lead to further actions as deemed necessary by the Company.</p>

<p><strong>Verification Fee:</strong> The Recruiter acknowledges that a verification fee may be required to undergo the verification process. This fee is non-refundable and is subject to change at the discretion of the Company.</p>

<p><strong>Duration of Verification:</strong> The verification of the Recruiter's business status is valid for a specified duration, as determined by the Company. The Recruiter agrees to renew the verification status upon expiration, subject to the terms and conditions in effect at the time of renewal.</p>

<p><strong>Verification Results:</strong> The Company reserves the right to approve or reject the verification application at its sole discretion. The Recruiter understands that the decision of the Company regarding verification status is final and binding.</p>

<p><strong>Consequences of Non-Compliance:</strong> The Recruiter acknowledges that failure to comply with the terms and conditions outlined in this Agreement may result in the suspension or termination of their account on the <em>JobLinkUp</em> platform, without refund or compensation.</p>

                </div>

                <div class="panel-body wt-panel-body p-a20 m-b30">

                <input type="checkbox" name="agree_to_terms">
                I hereby acknowledge  that I have read, understood, and agree to abide by the terms and conditions set forth in this Verification Agreement. 
        
                </div>
            </div>




            <div class="panel panel-default">
            <div class="col-lg-12 col-md-12">
                        
                        <div class="text-left">
                            <button type="submit" class="site-button m-r5">
                                    <?php echo URLROOT; recruiter/addBRDetails?> 
                                    Save changes and continue
                            </button>
                        </div>
                    </div>
            </div>

    </div>
    </form>
</div>
</div>

</div><!-- right side-->
</div> <!--right section panel-->

<script src="<?php echo URLROOT ?>/js/jobs/hashtags.js"></script>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>