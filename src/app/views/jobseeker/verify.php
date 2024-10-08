<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <form action="<?php echo URLROOT; ?>/jobseekers/verify" method="post" class="code-verification-form">
                <h2 class="title">Enter Verification Code</h2>
                <div class="input-field <?php echo (!empty($data['code_err'])) ? 'is-invalid' : ''; ?>">
                    <i class="fas fa-key"></i>
                    <input type="text" name="code" placeholder="Verification Code" value="">
                </div>
                <span class="invalid-feedback"><?php echo $data['code_err']; ?></span>
                <input type="submit" value="Verify" class="btn solid" />
                <!-- Resend Code Button -->
                <a href="<?php echo URLROOT; ?>/jobseekers/resend_code" id="resend-code">Resend Code</a>
            </form>
        </div>
    </div>
</div>
<div class="panels-container">
    <div class="panel left-panel">
        <div class="content">
            <h3>New here ?</h3>
            <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
                ex ratione. Aliquid!
            </p>
            <a href="<?php echo URLROOT; ?>/jobseekers/register">
                <button class="btn transparent" id="sign-up-btn">
                    Sign up
                </button>
            </a>
        </div>
        <img src="<?php echo URLROOT; ?>/img/log.svg" class="image" alt="" />
    </div>
    <div class="panel right-panel">
        <div class="content">
            <h3>One of us ?</h3>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
                laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn">
                Sign in
            </button>
        </div>
        <img src="<?php echo URLROOT; ?>/img/register.svg" class="image" alt="" />
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>