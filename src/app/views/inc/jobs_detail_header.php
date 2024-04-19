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
            <div class="section-full  p-t120 p-b90 bg-white">
                <div class="container">

                    <!-- BLOG SECTION START -->
                    <div class="section-content">