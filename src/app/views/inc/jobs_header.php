<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>JobLinkUp | <?php echo $data['title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.1/feather.js" integrity="sha512-AhOauw2qcwVua90XoRO6IdKuEZzM8TwSXuwhKB30+bwfiOlbVxcRYimdJQFlDrSViBWXex+zWaGu/WyGB0rxeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT ?>/css/<?php echo $data['style'] ?>" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="page-wraper">
        <header class="site-header header-style-3 mobile-sider-drawer-menu">
            <div class="sticky-wrapper" style="height: 90px;">
                <div class="sticky-header main-bar-wraper navbar-expand-lg is-fixed">
                    <div class="main-bar">
                        <div class="container-fluid clearfix">
                            <div class="logo-header">
                                <div class="logo-header-inner logo-header-one">
                                    <a href="<?php echo URLROOT ?>">
                                        <img src="<?php echo URLROOT ?>/img/logo-dark.png" alt="" />
                                    </a>
                                </div>
                            </div>
                            <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggler collapsed">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar icon-bar-first"></span>
                                <span class="icon-bar icon-bar-two"></span>
                                <span class="icon-bar icon-bar-three"></span>
                            </button>
                            <div class="nav-animation header-nav navbar-collapse collapse d-flex justify-content-center">
                                <ul class="nav navbar-nav">
                                    <li>
                                        <a href="<?php echo URLROOT ?>">Home</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo URLROOT ?>/jobs">Jobs</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo URLROOT ?>/jobseekers">Job Seekers</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo URLROOT ?>/recruiters">Job Recruiters</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo URLROOT ?>/aboutus">About Us</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo URLROOT ?>/contactus">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-content">
            <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image: url(<?php echo URLROOT ?>/img/1.jpg)">
                <div class="overlay-main site-bg-white opacity-01"></div>
                <div class="container">
                    <div class="wt-bnr-inr-entry">
                        <div class="banner-title-outer">
                            <div class="banner-title-name">
                                <h2 class="wt-title"><?php echo $data['header_title'] ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-full p-t120  p-b90 site-bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 rightSidebar">
                            <div class="side-bar">
                                <div class="sidebar-elements search-bx">
                                    <form>
                                        <div class="form-group mb-4">
                                            <h4 class="section-head-small mb-4">Keyword</h4>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Job Title or Keyword">
                                                <button class="btn" type="button"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <h4 class="section-head-small mb-4">Location</h4>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search location">
                                                <button class="btn" type="button"><i class="fas fa-map-marker-alt"></i></button>
                                            </div>
                                        </div>
                                        <div class="twm-sidebar-ele-filter">
                                            <h4 class="section-head-small mb-4">Type of employment</h4>
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input employment-checkbox" id="Freelance" value="Freelance">
                                                        <label class="form-check-label" for="Freelance">Freelance</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input employment-checkbox" id="Intership" value="Internship">
                                                        <label class="form-check-label" for="Intership">Internship</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input employment-checkbox" id="PartTime" value="Part-Time">
                                                        <label class="form-check-label" for="PartTime">Part Time</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input employment-checkbox" id="PartTime" value="Volunteer">
                                                        <label class="form-check-label" for="PartTime">Volunteer</label>
                                                    </div>
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
                                        </div>
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
                                    </div>
                                </div>
                            </div>
                            <div class="twm-advertisment" style="background-image:url(images/add-bg.jpg);">
                                <div class="overlay"></div>
                                <h4 class="twm-title">Recruiting?</h4>
                                <p>Get Best Matched Jobs On your <br>
                                    Email. Add Resume NOW!</p>
                                <a href="about-1.html" class="site-button white">Read More</a>
                            </div>
                        </div>