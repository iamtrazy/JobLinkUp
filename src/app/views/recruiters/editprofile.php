<form action="<?php /*echo URLROOT; ?>/recruiter/edit" method="post */" >

<div class="panel panel-default">
    <div class="panel-heading wt-panel-heading p-a20">
        <h4 class="panel-tittle m-a0">
            <i class="fa fa-suitcase"></i>Job Details
        </h4>
    </div>
    <div class="panel-body wt-panel-body p-a20 m-b30">
        <div class="row">
            <!--Job title-->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Job Title</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" name="topic" type="text" placeholder="Artist" required />
                        <i class="fs-input-icon fa fa-address-card"></i>
                    </div>
                </div>
            </div>
            <!--Job Category-->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group city-outer-bx">
                    <label>Job Category</label>
                    <div class="ls-inputicon-box">
                        <div class="">
                            <select name="category">
                                <option>Art & Design</option>
                                <option>Data Entry</option>
                                <option>Volunteer</option>
                                <option>IT and Computers</option>
                                <option>Miscellaneous</option>
                                <option>Other</option>
                            </select>
                        </div>
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
                                <option>Part Time</option>
                                <option>Temporary</option>
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
                        <input class="form-control" name="rate" type="text" placeholder="5000" required />
                        <i class="fs-input-icon fa fa-dollar-sign"></i>
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
                        Save changes
                        //redirect to the myprofile page and display the changes
                    </button>
                    <button type="cancel" class="site-button m-r5">
                        Cancel
                        //redirect to the profile page and display the original content
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</form>