<head><script src="<?php echo URLROOT ?> /js/find.js"></script>


</head>
<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>
<div class="section-full p-t120  p-b90 site-bg-white" style="transform: none;">
                <div class="container" style="transform: none;">
                    <div class="row" style="transform: none;">
                        <div class="col-xl-3 col-lg-4 col-md-12 rightSidebar m-b30" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                            <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; left: 531px; top: 0px;">
                                <div class="side-bar-st-1">
                                    <div class="twm-candidate-profile-pic">
                                        <img src="<?php echo URLROOT ?>/img/pic1.jpg" alt="">
                                        <div class="upload-btn-wrapper">
                                            <div id="upload-image-grid"></div>
                                            <button class="site-button button-sm">Upload Photo</button>
                                            <input type="file" name="myfile" id="file-uploader" accept=".jpg, .jpeg, .png">
                                        </div>
                                    </div>
                                    <div class="twm-mid-content text-center">
                                      
                                        
                                       
                                        <h4>Chamudi Siriwardhane <i class="fas fa-edit"></i></h4>
                                        
                                        <p>Joined on 2017 June</p>
                                        <p>Verified</p>
                                        <p>Zavolt Ltd.</p>
                                        <p><i class="fa-solid fa-location-dot"></i>From Sri Lanka</p>
                                    </div>

                                    </div>

                                    <div class="twm-nav-list-1">
                                        <ul>
                                            <li><a href="<?php echo URLROOT ?>/recruiters/dashboard"><i class="fa fa-tachometer-alt"></i>Dashboard</a></li>
                                            
                                        </ul>
</div><!--side bar-->
</div> <!--sticky side bar-->
</div><!--right side bar-->
                                    </div><!--row-->
                                </div><!--container-->
                            </div><!--section-->
<div class="col-xl-9 col-lg-8 col-md-12 m-b30"> <!--new section column-->
    <div class="twm-right-section-panel site-bg-gray">
        <form action="<?php echo URLROOT; ?>/jobs/add" method="post" >

            
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-suitcase"></i>User Reviews
                    </h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30">
                    <div class="row">
                        <!--Job title-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <h5>Location</h5>
                        </div>
                        <!--Job Category-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <h5>Current work</h5>
                        </div>
                        
                        <!--Job title-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            
                                <h5>Offered Salary</h5>
                                
                        </div>
                        <!--Website-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            
                                <h5>Website</h5>
                                
                        
                        </div>
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">
                        <i class="fa fa-suitcase"></i>Interests
                    </h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30">
                    <div class="row">
                        <!--Job title-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <h5>Location</h5>
                        </div>
                        <!--Job Category-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                          <h5>Current work</h5>
                        </div>
                        
                        <!--Job title-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            
                                <h5>Offered Salary</h5>
                                
                        </div>
                        <!--Website-->
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            
                                <h5>Website</h5>
                                
                        
                        </div>
                       
                       
                        <div class="col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" class="site-button m-r5" href="<?php echo URLROOT ?> /recruiter/editprofile" id="edit-profile-button">
                                    Edit profile

                                </button>
                            </div>
                        </div> <!--button-->
                        <div id="success-message">
                            <!--response eka daanna-->
                            <?php 
                            $jobmodel->jseditrecruiterdetails(); or
                            jsfinduser->loadform();
                            ?>
                        </div>
                        
                    </div>
                    
                                   
                                    
                                    

                </div>
            </div>
        </form>
    </div>
</div>
<!--email eka gannw-->