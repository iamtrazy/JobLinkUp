<head><link rel="stylesheet" href="<?php echo URLROOT ?>/css/recruiter/rating.css"></head>
<div class="panel">
  <div class="ratings-container">
    <h1>How satisfied are you with our customer support performance?</h1>
    <form action="" id="ratingForm">
      <fieldset class="rating">
        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="5 stars"></label>
        <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="4.5 stars"></label>
        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="4 stars"></label>
        <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="3.5 stars"></label>
        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="3 stars"></label>
        <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="2.5 stars"></label>
        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="2 stars"></label>
        <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="1.5 stars"></label>
        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="1 star"></label>
        <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="0.5 stars"></label>
    </fieldset>
    <textarea name="review" id="" cols="30" rows="10"></textarea>
    </form>
  </div>
</div>


<script>
    const form = document.getElementById('ratingForm');

form.onsubmit = function(e) {
  e.preventDefault();
  const valueStars = document.querySelector('input[name="rating"]:checked').value;
  showThankyou(valueStars);
}

function showThankyou(val) {
  const starText = val > 1 ? 'stars' : 'star';
  const panel = document.querySelector('.panel');
  panel.innerHTML = `
    <span class="fa-heart"></span>
    <h1>Thank you!</h1>
    <br>
    <strong>Feedback: ${val} ${starText}</strong>
    <p>We'll use your feedback to improve our support.</p>
  `;
}

function handleChange() {
  const inputRatings = document.querySelectorAll('input[name="rating"]');
  const submitBtn = document.querySelector('input[type="submit"]');
  
  inputRatings.forEach(input => {
    input.addEventListener('change', () => {
      if (input.checked === true) {
        submitBtn.disabled = false;
      }
    })
  })
}

handleChange();
</script>