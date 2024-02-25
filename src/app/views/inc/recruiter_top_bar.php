<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/recruiter/topbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/pages/sidebar.css">
</head>
<body>
<div class="main">
        <div class="topbar">
            <div class="toggle"> 
            <i class="fa-solid fa-bars menu-outline"></i>
            </div>

            <div class="logo">
                <img src="<?php echo URLROOT ?>/img/JobLinkUp-logo.png" style="height:150px; width:90px;"> 
                
            </div>
            <div>
                <ul>
                    <li><a href="#">Explore
                    <i class="fa-solid fa-angle-down"></i>
                    </a>
                    <div class="dropdown">
                        <ul>
                            <li><a href="">Job Categories</a></li>
                            <li><a href="">Job Categories</a></li>
                            <li><a href="">Job Categories
                            <i class="fa-solid fa-angle-right"></i>
                            </a></li>
                            <li><a href="">Job Categories</a></li>
                        </ul>
                    </div>
                </li>
                    <li><a href="#">Jobs</a></li>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">home</a></li>
                    
                    
                    
                </ul>
            </div>





            
            <div class="search"> 
                <label for="">
                    <input type="text" placeholder="Search Jobs...">
                    <i class="fa-solid fa-magnifying-glass search-outline"></i>
                </label>
            </div>
            <div class="user"> 
                <img src="<?php echo URLROOT ?>/img/profile-pic.png" alt="">
            </div>
        </div>

    </div>
    <script src="https://kit.fontawesome.com/d8ae8e94ca.js" crossorigin="anonymous"></script>
    <script>
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function(){
    navigation.classList.toggle("active");
    main.classList.toggle("active");
}
</script>

</body>
</html>
















