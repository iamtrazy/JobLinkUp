<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

    <style>
  @import url('https://fonts.googleapis.com/css2?family=Lato:ital@0;1&family=Maven+Pro:wght@600&family=Open+Sans:wght@500&display=swap');
</style>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/recruiter/my-profile.css">


</head>
<body>
    <div class="container">
        <div class="content_container">
            <img src="" alt="image unavailable">
        <h1 class="profile-heading">Chamudi Siriwardhane</h1>
        </div>



        <div class="content_container_2">
            heyy
            hi 
            <div class="item">
                hellloooo
            </div>


         <!--wrapper taken from recruiter/postjob.php form container -->

            <div class="wrapper">
    <form action="">
        <h1>Employer</h1>

        <!--seperated into rows-->
        <div class="profile-row">
            

<!--row item-->
        <div class="form-container">
            <label for="Job Title">
            <i class="fs-input-icon fa fa-address-card">
                Job Title:</label>
        <input type="text" placeholder="Eg :Dog Sitting" required>
        </div>
<!--row item-->

        <div class="">
        <label for="Job Category">Job Category
        </label>
        <select name="category" id="" placeholder="Data Entry">
                                            <option>Art & Design</option>
                                            <option>Art & Design</option>
                                            <option>Data Entry</option>
                                            <option>Volunteer</option>
                                            <option>IT and Computers</option>
                                            <option>Miscellaneous</option>
                                            <option>Other</option>                             
        </select>
        </div>

        <!--row item-->

        <div class="form-container">
        <i class="fs-input-icon fa fa-address-card">

        <label for="">Job type:</label>

        <input type="text" placeholder="Eg :Temporary" required>
           
                <select name="type" id="">
                <option>Freelance</option>
                <option>Part Time</option>
                <option>Temporary</option>
                </select>
        </div>

    
    
    
    
    
    </div>  <!--end of row-->
       
        
        <div class="">
        <i class="fs-input-icon fa fa-dollar-sign"></i>

            <label for="Offered Salary">Offered Salary (Rs.)</label>
        <input type="currency" placeholder="Eg :5000" required>
            

            <input type="radio">Negotiable
        </div>


<div class="form-container">
<i class="fs-input-icon fa fa-globe-americas"></i>

            <label for="Web site link">Enter your website link
            </label>
        <input type="text" placeholder="Eg :slt.lk" required>
            
            
        </div>

<div class="form-container">
<i class="fs-input-icon fa fa-home"></i>

            <label for="Complete address">Complete address</label>

            
        <input type="text" placeholder="707/3-B Station Road, Pannipitiya" required>
            
        </div>

<div class="form-container">
<i class="fs-input-icon fa fa-home"></i>

            <label for="description">job description</label>
        <textarea class="" rows="3" placeholder="Enter Job description here..." required></textarea>
            
        </div>

<!--radio buttons-->

<div class="radio-container">
<i class="fs-input-icon fa fa-home"></i>

            <label for="cv">Require CV? </label>
        <input type="radio">
        </div>

<div class="radio-container">
<i class="fs-input-icon fa fa-home"></i>

            <label for="cv">Enable Quiz</label>
        <input type="radio">
            
        </div>
<!--when clicked on upload documents option the upload button should appear-->
<div class="radio-container">
<i class="fs-input-icon fa fa-home"></i>

            <label for="documents">Upload additional Documents 
            </label>
        <input type="radio"> 
</div>

<!--submit buttons-->
        <div class="button-container upload">
            
       <button type="submit" class="">Upload documents</button>
        </div>


<div class="button-container publish ">
          
       <button type="submit" class="">Publish Job</button>
        </div>
    </form>
</div><!--wrapper-->
        </div>
    </div>
</body>
</html>