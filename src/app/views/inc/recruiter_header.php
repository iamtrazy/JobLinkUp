<!DOCTYPE html>
<html lang="en" style="transform: none">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>JobLinkUp | <?php echo $data['title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT ?>/css/<?php echo $data['style'] ?>" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<style>
    /* Default styles */
    .col-xl-3,
    .col-lg-4 {
        flex: 0 0 30%;
        max-width: 30%;
    }

    .col-xl-9,
    .col-lg-8 {
        flex: 0 0 70%;
        max-width: 70%;
    }

    /* Media queries for responsiveness */
    @media (max-width: 1200px) {

        .col-xl-3,
        .col-lg-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .col-xl-9,
        .col-lg-8 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 992px) {

        .col-xl-3,
        .col-lg-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .col-xl-9,
        .col-lg-8 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

<body style="transform: none;">

    <div class="page-wraper" style="transform: none;">
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
        <div class="page-content" style="transform: none;">
            <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url(<?php echo URLROOT ?>/img/1.jpg);">
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
            <div class="section-full p-t120  p-b90 site-bg-white" style="transform: none;">
                <div class="container" style="transform: none;">
                    <div class="row" style="transform: none;">
                        <div class="col-xl-3 col-lg-4 col-md-12 rightSidebar m-b30" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                            <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; left: 531px; top: 0px;">
                                <div class="side-bar-st-1">
                                    <div class="twm-candidate-profile-pic">
                                        <img src="<?php echo URLROOT . '/img/profile/' . $data['profile_image'] ?> " alt="">
                                    </div>
                                    <div class="twm-mid-content text-center">
                                        <h4><?php echo $_SESSION['business_name'] ?></h4>
                                        <p>Recruiter</p>
                                        <!-- <p>Joined on 2017 June</p>
                                        <p>Verified</p>
                                        <p>Zavolt Ltd.</p> -->
                                    </div>

                                    <div class="twm-nav-list-1">
                                        <ul>
                                            <li><a href="<?php echo URLROOT ?>/recruiters/dashboard"><i class="fa fa-tachometer-alt"></i>Dashboard</a></li>
                                            <li><a href="<?php echo URLROOT ?>/recruiters/profile"><i class="fa fa-user"></i> Recruiter Profile</a></li>
                                            <li><a href="<?php echo URLROOT ?>/recruiters/postjob"><i class="fa fa-book-reader"></i> Post A Job</a></li>
                                            <li><a href="<?php echo URLROOT ?>/recruiters/manage"><i class="fa fa-suitcase"></i> Manage Job Listings</a></li>
                                            <li><a href="<?php echo URLROOT ?>/candidates"><i class="fa fa-user-check"></i> Browse Applications</a></li>
                                            <li><a href="<?php echo URLROOT ?>/recruiters/chat"><i class="far fa-comments"></i>Chat</a></li>
                                            <li><a href="<?php echo URLROOT ?>/recruiters/transactions"><i class="fa fa-credit-card"></i>Verify Your Business</a></li>
                                            <li><a href="<?php echo URLROOT ?>/recruiters/changepassword"><i class="fa fa-fingerprint"></i> Change Password</a></li>
                                            <li><a href="<?php echo URLROOT ?>/recruiters/logout"><i class="fa fa-share-square"></i> Logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>