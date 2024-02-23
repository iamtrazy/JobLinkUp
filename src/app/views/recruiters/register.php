<?php require APPROOT . '/views/inc/recruiter_top_bar.php'; ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/recruiter/register.css">
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Lato:ital@0;1&family=Maven+Pro:wght@600&family=Open+Sans:wght@500&display=swap');
</style>

</head>
<body>
    <div class="container">

    <div class="content_container"><?php require APPROOT . '/views/inc/recruiter_top_bar.php'; ?>
</div>
 <div class="content_container">
 <div class="wrapper">
    <form action="">
        <h1>Register</h1>
        <div class="form-container">
            <label for="Username">
        <input type="text" placeholder="username" required>User Name:
            </label>
        </div>
        <div class="form-container">
        <label for="email">
        <input type="email" placeholder="email">Email
        </label>
        </div>
       
        <div class="form-container">
        <label>
        <input type="password" placeholder="password">Password
        </label>
        </div>
        <div class="form-container">
        <label>
        <input type="password" placeholder="confirm password">Confirm Password
        </label>
        </div>

        <div class="remember-me">
            <label for="">
                <input type="checkbox" name="" id=""> Remember Me
            </label>

            <a href="#">Forgot Password</a>
        </div>

        <button type="submit" class="btn">Log In</button>
        <div class="register-link">
            <p>don't have an account?
                <a href="#">Register</a>
            </p>
        </div>
    </form>
</div>
 </div>   <!--content-container-->
 </div> <!--container -->
</body>
</html>








<form action="<?php echo URLROOT; ?>/recruiters/login" method="post" class="sign-in-form">





<script src="<?php echo URLROOT; ?>/js/login.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>