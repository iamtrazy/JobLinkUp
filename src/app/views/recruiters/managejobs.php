<?php require APPROOT . '/views/inc/sidebar.php'; ?>

<form action="<?php echo URLROOT; ?>/jobs/add" method="post">
    

<body>
    <div class="main">
        <div class="topbar">
            <div class="toggle"> </div>
            <i name="menu-outline">

            </i>
            <div class="Search"> 
                <label for="">
                    <input type="text" placeholder="search here...">
                    <i name="search-outline"></i>
                </label>
            </div>
            <div class="user"> 
                <img src="assets/imgs/" alt="">
                <img src="<?php echo URLROOT ?>/img/blah.jpg" alt="">
            </div>
        </div>

    </div>
</body>

<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>