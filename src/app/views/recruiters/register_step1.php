<!--this containes the code for progress bar-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/recruiter/register_step1.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/recruiter/progress.min.css" />

</head>
<body>

    <div class="all-columns">

        <div class="content_container">
                 <!-- the progress bar-->
    <h1>Complete the profile step 1</h1>
    <div class="pss-bar" style="--pss-fill: 20%"></div>
    <div class="pss-bar" style="--pss-fill: 20%" data-pss="20%">&lt;/div>
    <div class="pss-bar" style="--pss-fill: 20%; --pss-color: blue"></div>

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
    <div class="wrapper">
<form action="http://joblinkup.com/jobrecruiters/register" method="post" class="sign-up-form">
                
                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    <label for="fullname">What's your full name?</label>
                    <input type="text" name="fullname" placeholder="Eg. Chamudi Siriwardhane" value="">
                    
                </div>
                <span class="invalid-feedback"></span>
                
                <span class="invalid-feedback"></span>
                <!-- <div class="input-field ">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <input type="password" name="password" placeholder="Password" value="">
                </div> -->


                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    What's your contact number?
                    <input type="text" name="contactno" placeholder="021 XXXXXXX" value="">
                </div>
                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    Where are you currently located? (City and State)
                    <input type="text" name="location" placeholder="Colombo 7" value="">
                </div>
                <div class="input-field ">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    How would you summarize your professional background in one sentence? (e.g., "Experienced Web Developer" or "Recent Graduate in Marketing")
                    <input type="textarea" name="professional_bg" placeholder="I am unemployed/ I am a student" value="">
                </div>

                <!-- <span class="invalid-feedback"></span>
               
                <span class="invalid-feedback"></span>
                <input type="submit" value="Register" class="btn">
                <p class="social-text">Or Sign up with social platforms</p> -->
                
            
        </div>      
            <!--buttons-->
            <input type="submit" value="Save" class="btn">  
                
            <a href="<?php echo URLROOT ?>/recruiters/setupprofile_step2">
                <input type="submit" value="Next" class="btn">
            </a>
            
        </p>

        </form>


        </div>

        
    </div>
   
    
</body>
</html>












