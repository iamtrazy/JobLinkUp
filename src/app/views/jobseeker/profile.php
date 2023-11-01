<?php require APPROOT . '/views/inc/seeker_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
  <div class="twm-right-section-panel site-bg-gray">
    <form>
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
                  <input class="form-control" name="company_name" type="text" placeholder="Devid Smith" />
                  <i class="fs-input-icon fa fa-user"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="form-group">
                <label>Phone</label>
                <div class="ls-inputicon-box">
                  <input class="form-control" name="company_phone" type="text" placeholder="(251) 1234-456-7890" />
                  <i class="fs-input-icon fa fa-phone-alt"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="form-group">
                <label>Email Address</label>
                <div class="ls-inputicon-box">
                  <input class="form-control" name="company_Email" type="email" placeholder="Devid@example.com" />
                  <i class="fs-input-icon fas fa-at"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="form-group">
                <label>Website</label>
                <div class="ls-inputicon-box">
                  <input class="form-control" name="company_website" type="text" placeholder="https://devsmith.net" />
                  <i class="fs-input-icon fa fa-globe-americas"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="form-group">
                <label>Qualification</label>
                <div class="ls-inputicon-box">
                  <input class="form-control" name="company_since" type="text" placeholder="BTech" />
                  <i class="fs-input-icon fa fa-user-graduate"></i>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-12">
              <div class="form-group city-outer-bx has-feedback">
                <label>Age</label>
                <div class="ls-inputicon-box">
                  <input class="form-control" name="company_since" type="text" placeholder="35 Years" />
                  <i class="fs-input-icon fa fa-child"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12">
              <div class="form-group city-outer-bx has-feedback">
                <label>Full Address</label>
                <div class="ls-inputicon-box">
                  <input class="form-control" name="company_since" type="text" placeholder="1363-1385 Sunset Blvd Angeles, CA 90026 ,USA" />
                  <i class="fs-input-icon fas fa-map-marker-alt"></i>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="3">Greetings! when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</textarea>
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
                <label>linkedin</label>
                <div class="ls-inputicon-box">
                  <input class="form-control wt-form-control" name="company_name" type="text" placeholder="https://in.linkedin.com/" />
                  <i class="fs-input-icon fab fa-linkedin-in"></i>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="form-group">
                <label>Whatsapp</label>
                <div class="ls-inputicon-box">
                  <input class="form-control wt-form-control" name="company_name" type="text" placeholder="https://www.whatsapp.com/" />
                  <i class="fs-input-icon fab fa-whatsapp"></i>
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
        </div>
      </div>
    </form>
  </div>
</div>
<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>