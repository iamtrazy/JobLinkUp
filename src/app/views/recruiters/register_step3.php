<!--this containes the code for progress bar-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/recruiter/register_step3.css">
</head>
<body>
    <!-- the progress bar-->
    <h1>Complete the profile step 3</h1>
    <div class="container">
        <div class="rectangle start">
        <div class="circle-container">
            <div class="outer-outer-circle">
                <div class="outer-circle">
                
                    <div class="circle">
                        <div class="step">
                            <h1 class="step-number">1</h1>
                        </div>
                    </div>
                </div>
            </div> <!--outer-outer-circle-->
        </div><!--circle container-->
    </div><!--rectangle stra-->


        <div class="rectangle">
        <div class="circle-container">
            

            
            <div class="outer-outer-circle">
                <div class="outer-circle">
                
                    <div class="circle">
                        <div class="step">
                            <h1 class="step-number">2</h1>
                        </div>
                    </div>
                </div>
            </div> <!--outer-outer-circle-->
        
        </div><!--circle container-->
    </div><!--rectangle-->

        <div class="rectangle end">
        <div class="circle-container">
            <div class="outer-outer-circle">
                <div class="outer-circle">
                
                    <div class="circle">
                        <div class="step">
                            <h1 class="step-number">3</h1>
                        </div>
                    </div>
                </div>
            </div> <!--outer-outer-circle-->
        </div><!--circle container-->
    </div><!--rectangle-->
    </div><!--container-->

<!-- the form-->
<p>
<form action="http://joblinkup.com/jobrecruiters/register" method="post" class="sign-up-form">
                
                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    Please list your previous work experience.<input type="text" name="name" placeholder="Username" value="">
                </div>
                <span class="invalid-feedback"></span>
                <div class="input-field ">
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                    What was your job title?<input type="email" name="email" placeholder="Email" value="">
                </div>
                <span class="invalid-feedback"></span>
                <!-- <div class="input-field ">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <input type="password" name="password" placeholder="Password" value="">
                </div> -->


                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    Where did you work?<input type="text" name="name" placeholder="Username" value="">
                </div>
                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    When did you work there? (Start and End Date)<input type="text" name="name" placeholder="Username" value="">
                </div>
                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    Describe your roles and responsibilities.<input type="text" name="name" placeholder="Username" value="">
                </div>
                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    What is your education level?<input type="text" name="name" placeholder="Username" value="">
                </div>
                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    What was your major or specialization?<input type="text" name="name" placeholder="Username" value="">
                </div>
                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    When did you graduate?<input type="text" name="name" placeholder="Username" value="">
                </div>
                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    What skills do you possess? (e.g., programming languages, design software, marketing skills)<input type="text" name="name" placeholder="Username" value="">
                </div>
                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    Do you have any relevant certifications or licenses?<input type="text" name="name" placeholder="Username" value="">
                </div>

                <!-- <span class="invalid-feedback"></span>
               
                <span class="invalid-feedback"></span>
                <input type="submit" value="Register" class="btn">
                <p class="social-text">Or Sign up with social platforms</p> -->
                
            </form>
            <a href="<?php echo URLROOT ?>/recruiters/setupprofile_step2">
                <input type="submit" value="Back" class="btn">
            </a>
            <a href="#">
                <input type="submit" value="Finish" class="btn">
            </a>
        </p>

    
    
</body>
</html>












