
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Lato:ital@0;1&family=Maven+Pro:wght@600&family=Open+Sans:wght@500&display=swap');
</style>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/recruiter/dashboardd.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="cardBox">
        <div class="card">
            <div>
            <div class="numbers">1,504</div>
            <div class="cardName">Recruiter Rating</div>
            </div>

            <div class="iconBx">
                
            </div>

        </div> <!--card -->

        <div class="card">
            <div>
            <div class="numbers">1,504</div>
            <div class="cardName">No of Job Listings</div>
            </div>

            <div class="iconBx">
                
            </div>

        </div>  <!--card-->
        <div class="card">
            <div>
            <div class="numbers">Engagement</div>
            <div class="cardName"></div>
            </div>

            <div class="iconBx">
                
            </div>

        </div>  <!--card-->
        <div class="card">
            <div>
            <div class="numbers">1,504</div>
            <div class="cardName">Pending applications</div>
            </div>

            <div class="iconBx">
                
            </div>

        </div>  <!--card-->
        <div class="card">
            <div>
            <div class="numbers">1,504</div>
            <div class="cardName">Active Job Listings</div>
            </div>

            <div class="iconBx">
                
            </div>

        </div>  <!--card-->
    </div> <!-- card-box-->




    <!--add charts-->
    <div class="graphbox">
        <h2>No Of Clicks</h2>
        <div class="box">
            <canvas id="myChart" width="200px" height="200px"></canvas>
        </div>
        <div class="box">
            <canvas id="myChart" width="400px" height="400px"></canvas>
        </div>
        <div class="box">
            <canvas id="myChart" width="400px" height="400px"></canvas>
        </div>
       
    </div>



    <h1>recent activities</h1>
    <p>here there is a feed of activities related to job postings and applicant interactions.</p>
    new job postings <br>
    applicant submissions <br>
    messages received <br>
    <h1>notifications</h1>
    upcoming application deadlines <br>
    new applicant messages <br>
    review applications

    <h1>featured job postings</h1>
    <h1>upcoming recruiting events</h1>
    <h1>documents</h1>
    <h1>analytics</h1>
    <p>number of applicants per job posting, job posting performance
    conversion rates
    time to fill, applicant engagement, candidate demographics,
job posting effectiveness,recruitment pipeline, </p>
<h1>recruiter performance</h1>
<p>
    time to fill, applicant satisfaction, recruiter rating, hiring diversity
</p>
<!-- <script src="<?php echo URLROOT ?>/js/recruiter/my_Chart.js"></script> -->
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      responsive:true,
    }
  });
</script>
</body>

</html>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>