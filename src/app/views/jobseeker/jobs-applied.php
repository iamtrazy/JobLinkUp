<?php require APPROOT . '/views/inc/seeker_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
  <div class="twm-right-section-panel candidate-save-job site-bg-gray">
    <div class="product-filter-wrap d-flex justify-content-between align-items-center">
      <span class="woocommerce-result-count-left">Applied 3 jobs</span>

      <form class="woocommerce-ordering twm-filter-select" method="get">
        <span class="woocommerce-result-count">Sort By</span>
        <div class="dropdown bootstrap-select wt-select-bar-2">
          <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
            <option selected="selected">Most Recent</option>
            <option>Freelance</option>
            <option>Full Time</option>
            <option>Internship</option>
            <option>Part Time</option>
            <option>Temporary</option>
          </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="Most Recent">
            <div class="filter-option">
              <div class="filter-option-inner">
                <div class="filter-option-inner-inner">
                  Most Recent
                </div>
              </div>
            </div>
          </button>
          <div class="dropdown-menu">
            <div class="bs-searchbox">
              <input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-1" aria-autocomplete="list" />
            </div>
            <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1">
              <ul class="dropdown-menu inner show" role="presentation"></ul>
            </div>
          </div>
        </div>
        <div class="dropdown bootstrap-select wt-select-bar-2">
          <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
            <option selected="selected">Show 10</option>
            <option>Show 20</option>
            <option>Show 30</option>
            <option>Show 40</option>
            <option>Show 50</option>
            <option>Show 60</option>
          </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox" aria-expanded="false" title="Show 10">
            <div class="filter-option">
              <div class="filter-option-inner">
                <div class="filter-option-inner-inner">
                  Show 10
                </div>
              </div>
            </div>
          </button>
          <div class="dropdown-menu">
            <div class="bs-searchbox">
              <input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-2" aria-autocomplete="list" />
            </div>
            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
              <ul class="dropdown-menu inner show" role="presentation"></ul>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="twm-jobs-list-wrap">
      <ul>
        <li>
          <div class="twm-jobs-list-style1 mb-5">
            <div class="twm-media">
              <img src="../img/pic1.jpg" alt="#" />
            </div>
            <div class="twm-mid-content">
              <a href="#" class="twm-job-title">
                <h4>
                  Type setting<span class="twm-job-post-duration">/ 1 days ago</span>
                </h4>
              </a>
              <p class="twm-job-address">
                1363-1385 Sunset avenue, 90026, Colombo , LK
              </p>
            </div>
            <div class="twm-right-content">
              <div class="twm-jobs-category green">
                <span class="twm-bg-green">New</span>
              </div>
              <div class="twm-jobs-amount">
                LKR 2500 <span>/ Month</span>
              </div>
              <a href="#" class="twm-jobs-browse site-text-primary">Job Details</a>
            </div>
          </div>
        </li>

        <li>
          <div class="twm-jobs-list-style1 mb-5">
            <div class="twm-media">
              <img src="../img/pic1.jpg" alt="#" />
            </div>
            <div class="twm-mid-content">
              <a href="#" class="twm-job-title">
                <h4>
                  Wordpress Web Design<span class="twm-job-post-duration">/ 12 days ago</span>
                </h4>
              </a>
              <p class="twm-job-address">
                1363-1385 Sunset avenue, 90026, Colombo , LK
              </p>
            </div>
            <div class="twm-right-content">
              <div class="twm-jobs-category green">
                <span class="twm-bg-brown">Expired</span>
              </div>
              <div class="twm-jobs-amount">
                LKR 6500 <span>/ Month</span>
              </div>
              <a href="#" class="twm-jobs-browse site-text-primary">Job Details</a>
            </div>
          </div>
        </li>

        <li>
          <div class="twm-jobs-list-style1 mb-5">
            <div class="twm-media">
              <img src="../img/pic1.jpg" alt="#" />
            </div>
            <div class="twm-mid-content">
              <a href="#" class="twm-job-title">
                <h4 class="twm-job-title">
                  Data Entry<span class="twm-job-post-duration">
                    / 13 days ago
                  </span>
                </h4>
              </a>
              <p class="twm-job-address">
                1363-1385 Sunset avenue, 90026, Colombo , LK
              </p>
            </div>
            <div class="twm-right-content">
              <div class="twm-jobs-category green">
                <span class="twm-bg-purple">Waiting</span>
              </div>
              <div class="twm-jobs-amount">
                LKR 4000 <span>/ Month</span>
              </div>
              <a href="#" class="twm-jobs-browse site-text-primary">Job Details</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>