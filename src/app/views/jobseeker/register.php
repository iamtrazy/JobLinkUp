<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <form action="<?php echo URLROOT; ?>/jobseekers/login" method="post" class="sign-in-form">
                <?php echo flash('register_success'); ?>
                <h2 class="title">Sign in</h2>
                <div class="input-field <?php echo (!empty($data['login_email_err'])) ? 'is-invalid' : ''; ?>">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="login_email" placeholder="Email" value="<?php echo $data['login_email']; ?>">
                </div>
                <span class="invalid-feedback"><?php echo $data['login_email_err']; ?></span>
                <div class="input-field <?php echo (!empty($data['login_password_err'])) ? 'is-invalid' : ''; ?>">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="login_password" placeholder="Password" value="<?php echo $data['login_password']; ?>">
                </div>
                <span class="invalid-feedback"><?php echo $data['login_password_err']; ?></span>
                <input type="submit" value="Login" class="btn solid" />
                <!-- <p class="social-text">Or Sign in with social platforms</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div> -->
            </form>
            <form action="<?php echo URLROOT; ?>/jobseekers/register" method="post" class="sign-up-form">
                <h2 class="title">Sign up</h2>
                <div class="input-field <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="Username" value="<?php echo $data['name']; ?>">
                </div>
                <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>

                <div class="input-field <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" value="<?php echo $data['email']; ?>">
                </div>
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                <div class="input-field">
                    <i class="fas fa-venus-mars"></i>
                    <select name="gender" class="form-control">
                        <option value="select">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <!-- Handle errors for Gender field -->
                <span class="invalid-feedback"><?php echo $data['gender_err']; ?></span>
                <div class="input-field <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" value="<?php echo $data['password']; ?>">
                </div>
                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                <div class="input-field <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php echo $data['confirm_password']; ?>">
                </div>
                <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                <input type="submit" value="Register" class="btn" value="Sign up" />
                <!-- <p class="social-text">Or Sign up with social platforms</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div> -->
            </form>
        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>New here ?</h3>
                <p>
                    Ready to discover exciting part-time opportunities? Dive into our platform and find part-time roles that align with your skills and interests. Whether you're looking to gain experience, earn extra income, or pursue your passion, we've got you covered!
                </p>
                <button class="btn transparent" id="sign-up-btn">
                    Sign up
                </button>
            </div>
            <img src="<?php echo URLROOT; ?>/img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>One of us ?</h3>
                <p>
                    Looking for flexible work opportunities to fit your schedule? Whether you're a student, a parent, or someone seeking supplementary income, part-time jobs offer the flexibility you need. Explore a variety of part-time roles ranging from retail and hospitality to freelance gigs and online tutoring.
                </p>
                </p>
                <button class="btn transparent" id="sign-in-btn">
                    Sign in
                </button>
            </div>
            <img src="<?php echo URLROOT; ?>/img/register.svg" class="image" alt="" />
        </div>
    </div>
</div>
<script src="<?php echo URLROOT; ?>/js/login.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>