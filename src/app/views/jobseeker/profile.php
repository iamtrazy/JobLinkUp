<?php require APPROOT . '/views/inc/seeker_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
  <?php if (!empty($data['message'])) : ?>
    <div class="alert alert-info" role="alert">
      <strong>Complete Your Profile:</strong> Please fill in the required fields below and add keywords to receive personalized job recommendations.
    </div>
  <?php endif; ?>
  <div class="twm-right-section-panel site-bg-gray">
    <form method="post" action="<?php echo URLROOT . '/jobseekers/edit_profile' ?>" enctype="multipart/form-data">
      <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
          <h4 class="panel-tittle m-a0">Basic Informations</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="form-group">
                <label>Your Name</label>
                <div class="ls-inputicon-box">
                  <input id="username" class="form-control" name="username" type="text" placeholder="Devid Smith" minlength="2" maxlength="255" />
                  <i class="fs-input-icon fa fa-user"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="form-group">
                <label>Phone</label>
                <div class="ls-inputicon-box">
                  <input id="phone" class="form-control" name="phone_no" type="text" placeholder="07xxxxxxxx" minlength="10" maxlength="15">
                  <i class="fs-input-icon fa fa-phone-alt"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="form-group">
                <label>Email Address</label>
                <div class="ls-inputicon-box">
                  <input id="email" class="form-control" name="email" type="email" placeholder="Devid@example.com" disabled />
                  <i class="fs-input-icon fas fa-at"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="form-group">
                <label>Website</label>
                <div class="ls-inputicon-box">
                  <input id="website" class="form-control" name="website" type="text" placeholder="https://example.net" minlength="5" maxlength="255" />
                  <i class="fs-input-icon fa fa-globe-americas"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="form-group city-outer-bx has-feedback">
                <label>Age</label>
                <div class="ls-inputicon-box">
                  <input id="age" class="form-control" name="age" type="number" min="0" max="100" placeholder="Enter age" />
                  <i class="fs-input-icon fa fa-child"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="form-group city-outer-bx has-feedback">
                <label>Gender</label>
                <div class="ls-inputicon-box">
                  <select id="gender" class="form-control" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                  <i class="fs-input-icon fa fa-venus-mars"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12">
              <div class="form-group city-outer-bx has-feedback">
                <label>Full Address</label>
                <div class="ls-inputicon-box">
                  <input id="address" class="form-control" name="address" type="text" placeholder="1363-1385 Sunset Blvd Angeles, CA 90026 ,USA" minlength="10" maxlength="255" />
                  <i class="fs-input-icon fas fa-map-marker-alt"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12">
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" name="location_rec" type="checkbox" id="locationCheckbox">
                  <label class="form-check-label" for="locationCheckbox">
                    Recommend me jobs based on my location
                  </label>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>About Me</label>
                <textarea id="about" class="form-control" name="about" rows="3" minlength="2" maxlength="255" placeholder="Enter your description about yourself."></textarea>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>Enter Keywords for Job Recommendations</label>
                <textarea id="keywords" class="form-control" name="keywords" rows="3" minlength="2" maxlength="255" placeholder="Please enter keywords related to your skills, experience, and interests."></textarea>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="form-group">
                <label for="profile-upload" class="custom-profile-upload">
                  <i class="fas fa-upload"></i> Profile Image
                </label>
                <input id="profile-upload" type="file" name="profile_image" accept=".jpg, .jpeg, .png" />
              </div>
            </div>

            <!-- New upload CV button -->
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="form-group">
                <div class="custom-file">
                  <label for="cv-upload" class="custom-cv-upload">
                    <i class="fas fa-upload"></i> Your CV
                  </label>
                  <input id="cv-upload" type="file" name="cv" accept=".pdf" />
                </div>
              </div>
            </div>

          </div>
        </div>

        <!--Social Network-->
        <div class="panel panel-default">
          <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">Social Network</h4>
          </div>
          <div class="panel-body wt-panel-body p-a20 m-b30">
            <div class="row">

              <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                  <label>Linkedin</label>
                  <div class="ls-inputicon-box">
                    <input id="linkedin_url" class="form-control wt-form-control" name="linkedin_url" type="text" placeholder="https://in.linkedin.com/" minlength="10" maxlength="255" />
                    <i class="fs-input-icon fab fa-linkedin-in"></i>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                  <label>Whatsapp</label>
                  <div class="ls-inputicon-box">
                    <input id="whatsapp_url" class="form-control wt-form-control" name="whatsapp_url" type="text" placeholder="https://www.whatsapp.com/" minlength="10" maxlength="255" />
                    <i class="fs-input-icon fab fa-whatsapp"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 col-md-12">
          <div class="text-left">
            <button type="submit" class="site-button">
              Save Changes
            </button>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>

<script>
  $(document).ready(function() {
    // AJAX request to fetch job seeker details
    $.ajax({
      url: "<?php echo URLROOT; ?>/api/seeker_profile/<?php echo $_SESSION['user_id']; ?>",
      method: "GET",
      dataType: "json",
      success: function(response) {
        // Populate form fields with fetched data
        $('#username').val(response.username);
        $('#email').val(response.email);
        $('#gender').val(response.gender);
        $('#phone').val(response.phone_no);
        $('#website').val(response.website);
        $('#age').val(response.age === 0 ? '' : response.age); // If age is zero, leave the field empty
        $('#address').val(response.address);
        $('#locationCheckbox').prop('checked', response.location_rec == 1); // Check location_rec checkbox based on received boolean value
        $('#about').val(response.about);
        $('#keywords').val(response.keywords);
        $('#locationCheckbox').val(response.location_rec);
        $('#linkedin_url').val(response.linkedin_url); // Populate linkedin_url field
        $('#whatsapp_url').val(response.whatsapp_url); // Populate whatsapp_url field
        // You can populate other form fields in a similar manner
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
        // Handle error
      }
    });
    $('#locationCheckbox').change(function() {
      if ($(this).is(':checked')) {
        $('#locationCheckbox').val('1'); // If checkbox is checked, set the value to 1
      } else {
        $('#locationCheckbox').val('0'); // If checkbox is unchecked, set the value to 0
      }
    });
  });
</script>