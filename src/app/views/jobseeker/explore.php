<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>

<body>

<!--debug statement-->
<?php print_r($data['all_seekers']); ?>

<!--row--> 
	
      
        <!-- CONTENT START -->
        <div class="page-content">

            


            <!-- OUR BLOG START -->
            <div class="section-full p-t120  p-b90 site-bg-white">
                

                <div class="container">
                    <div class="row">
<!--                         
                        <div class="col-lg-4 col-md-12 rightSidebar">

                            <div class="side-bar">

                                <div class="sidebar-elements search-bx">
                                                                            
                                    <form>

                                        <div class="form-group mb-4">
                                            <h4 class="section-head-small mb-4">Category</h4>
                                            <select class="wt-select-bar-large selectpicker"  data-live-search="true" data-bv-field="size">
                                                <option selected>All Category</option>
                                                <option>Web Designer</option>
                                                <option>Developer</option>
                                                <option>Acountant</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-4">
                                            <h4 class="section-head-small mb-4">Keyword</h4>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Job Title or Keyword">
                                                <button class="btn" type="button"><i class="feather-search"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <h4 class="section-head-small mb-4">Location</h4>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search location">
                                                <button class="btn" type="button"><i class="feather-map-pin"></i></button>
                                            </div>
                                        </div>

                                        <div class="twm-sidebar-ele-filter">
                                            <h4 class="section-head-small mb-4">Job Type</h4>
                                            <ul>
                                                <li>
                                                    <div class=" form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Freelance</label>
                                                    </div>
                                                    <span class="twm-job-type-count">09</span>
                                                </li>

                                                <li>
                                                    <div class=" form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                                        <label class="form-check-label" for="exampleCheck2">Full Time</label>
                                                    </div>
                                                    <span class="twm-job-type-count">07</span>
                                                </li>

                                                <li>
                                                    <div class=" form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck3">
                                                        <label class="form-check-label" for="exampleCheck3">Internship</label>
                                                    </div>
                                                    <span class="twm-job-type-count">15</span>
                                                </li>

                                                <li>
                                                    <div class=" form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck4">
                                                        <label class="form-check-label" for="exampleCheck4">Part Time</label>
                                                    </div>
                                                    <span class="twm-job-type-count">20</span>
                                                </li>

                                                <li>
                                                    <div class=" form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck5">
                                                        <label class="form-check-label" for="exampleCheck5">Temporary</label>
                                                    </div>
                                                    <span class="twm-job-type-count">22</span>
                                                </li>

                                                <li>
                                                    <div class=" form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck6">
                                                        <label class="form-check-label" for="exampleCheck6">Volunteer</label>
                                                    </div>
                                                    <span class="twm-job-type-count">25</span>
                                                </li>

                                            </ul>
                                        </div>

                                        <div class="twm-sidebar-ele-filter">
                                            <h4 class="section-head-small mb-4">Date Posts</h4>
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="exampleradio1">
                                                        <label class="form-check-label" for="exampleradio1">Last hour</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="exampleradio2">
                                                        <label class="form-check-label" for="exampleradio2">Last 24 hours</label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="exampleradio3">
                                                        <label class="form-check-label" for="exampleradio3">Last 7 days</label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="exampleradio4">
                                                        <label class="form-check-label" for="exampleradio4">Last 14 days</label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="exampleradio5">
                                                        <label class="form-check-label" for="exampleradio5">Last 30 days</label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="exampleradio6">
                                                        <label class="form-check-label" for="exampleradio6">All</label>
                                                    </div>
                                                </li>
                             
                                            </ul>
                                        </div> <!--sidebar ele filter-->
<!-- 
                                        <div class="twm-sidebar-ele-filter">
                                            <h4 class="section-head-small mb-4">Type of employment</h4>
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="Freelance1">
                                                        <label class="form-check-label" for="Freelance1">Freelance</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="FullTime1">
                                                        <label class="form-check-label" for="FullTime1">Full Time</label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="Intership1">
                                                        <label class="form-check-label" for="Intership1">Intership</label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="Part-Time1">
                                                        <label class="form-check-label" for="Part-Time1">Part Time</label>
                                                    </div>
                                                </li>
                             
                                            </ul>
                                        </div> <!--sidebar ele filter-->
<!--                                         
                                    </form>
                                    
                                </div>

                                <div class="widget tw-sidebar-tags-wrap">
                                    <h4 class="section-head-small mb-4">Tags</h4>
                                    
                                    <div class="tagcloud">
                                        <a href="job-list.html">General</a>
                                        <a href="job-list.html">Jobs </a>
                                        <a href="job-list.html">Payment</a>                                            
                                        <a href="job-list.html">Application </a>
                                        <a href="job-list.html">Work</a>
                                        <a href="job-list.html">Recruiting</a>
                                        <a href="job-list.html">Employer</a>
                                        <a href="job-list.html">Income</a>
                                        <a href="job-list.html">Tips</a>
                                    </div><!--tagcloud-->
                                </div> <!--tag wrap-->
<!-- 
                                
                            </div><!--sidebar -->

                            <!-- <div class="twm-advertisment" style="background-image:url(images/add-bg.jpg);">
                               <div class="overlay"></div>
                               <h4 class="twm-title">Recruiting?</h4>
                               <p>Get Best Matched Jobs On your <br>
                                Email. Add Resume NOW!</p>
                                <a href="about-1.html" class="site-button white">Read More</a> 
                            </div> advertisement -->

                        <!-- </div> -->

                        <div class="col-lg-8 col-md-12 my-section-2">
                            <!--Filter Short By-->
                            <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
                                <span class="woocommerce-result-count-left">Showing 2,150 Candidates</span>
                               
                                


                                <form class="woocommerce-ordering twm-filter-select" method="get">
                                    <span class="woocommerce-result-count">Sort By</span>
                                    <div class="dropdown bootstrap-select wt-select-bar-2"><select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                                        <option>Most Recent</option>
                                        <option>Freelance</option>
                                        <option>Full Time</option>
                                        <option>Internship</option>
                                        <option>Part Time</option>
                                        <option>Temporary</option>
                                    </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox" aria-expanded="false" title="Most Recent"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Most Recent</div></div> </div></button><div class="dropdown-menu "><div class="bs-searchbox"><input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-2" aria-autocomplete="list"></div><div class="inner show" role="listbox" id="bs-select-2" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
                                    <div class="dropdown bootstrap-select wt-select-bar-2"><select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
                                        <option>Show 10</option>
                                        <option>Show 20</option>
                                        <option>Show 30</option>
                                        <option>Show 40</option>
                                        <option>Show 50</option>
                                        <option>Show 60</option>
                                    </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-3" aria-haspopup="listbox" aria-expanded="false" title="Show 10"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Show 10</div></div> </div></button><div class="dropdown-menu "><div class="bs-searchbox"><input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-3" aria-autocomplete="list"></div><div class="inner show" role="listbox" id="bs-select-3" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
                                </form>

                            </div>

                            <div class="twm-candidates-grid-wrap">
                            <!-- php for each -->
                            <?php foreach ($data['all_seekers'] as $seeker) : ?>
                                <div class="row">
                                        
                                    <div class="col-lg-6 col-md-6">
                                         <div class="twm-candidates-grid-style1 mb-5">
                                             <div class="twm-media">
                                                 <div class="twm-media-pic">
                                                 <img src="<?php echo URLROOT ?>/img/pic4.jpg" alt="">
                                                 </div>
                                                 <!-- <div class="twm-candidates-tag"><span>10 jobs</span></div> -->
                                             </div>
                                             <div class="twm-mid-content">
                                                 <a href="candidate-detail.html" class="twm-job-title">
                                                     <h4> <?php echo $seeker->username;?> </h4>
                                                 </a>
                                                 <div class="mid-mid-content">
                                                 <a href="candidate-detail.html" class="twm-view-prifile site-text-primary">View Profile</a>
                                                 <a href="candidate-detail.html" class="twm-download-resume site-text-primary">Resume</a>
                                                 
                                                 </div>
                                                 
                                                 <div class="twm-fot-content">
                                                     <div class="twm-left-info">
                                                        <p class="twm-candidate-address"><i class="fa-solid fa-location-dot"></i>malabe</p>
                                                        <div class="twm-jobs-vacancies">10 employments </div>
                                                     </div>
                                                    
                                                </div>
                                             </div>
                                             
                                         </div>
                                    </div> <!--card finish-->


                                    
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

                        </div> <!--product filter grid start-->
                        <!--end for each-->
                        <?php endforeach;?>

                    </div><!--col-lg-8 col-m8--><!--row-->
                </div><!--container-->
            </div>   <!--section-->
            <!-- OUR BLOG END -->
    
        </div>
        <!-- CONTENT END -->


        
     
 	</div>



</body>

</html>
