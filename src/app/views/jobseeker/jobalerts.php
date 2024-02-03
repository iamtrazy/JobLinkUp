<?php require APPROOT . '/views/inc/seeker_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
  <div class="twm-right-section-panel candidate-save-job site-bg-gray">
    <div class="product-filter-wrap d-flex justify-content-between align-items-center">
      <span class="woocommerce-result-count-left">Job Alerts</span>
      <form class="woocommerce-ordering twm-filter-select" method="get">
        <span class="woocommerce-result-count">Sort By</span>
        <div class="dropdown bootstrap-select wt-select-bar-2">
          <select class="wt-select-bar-2 selectpicker" data-live-search="true" data-bv-field="size">
            <option selected="selected">Last 2 Months</option>
            <option>Last 1 Months</option>
            <option>15 days ago</option>
            <option>Weekly</option>
            <option>Yesterday</option>
            <option>Today</option>
          </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="Last 2 Months">
            <div class="filter-option">
              <div class="filter-option-inner">
                <div class="filter-option-inner-inner">
                  Last 2 Months
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
      </form>
    </div>
    <div class="table-responsive">
      <table class="table twm-table table-striped table-borderless">
        <thead>
          <tr>
            <th>Title</th>
            <th>Jobs Description</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Web Developer</td>
            <td>A strategic approach to website design..</td>
            <td>28/06/2023</td>
            <td>
              <a data-bs-toggle="modal" href="#saved-jobs-view" role="button" class="custom-toltip">
                <span class="fa fa-eye"></span>
                <span class="custom-toltip-block">Veiw</span>
              </a>
              <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Delete">
                <i class="fa fa-trash-alt"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td>SEO Experts</td>
            <td>Providing the best SEO practices.</td>
            <td>28/06/2023</td>
            <td>
              <a data-bs-toggle="modal" href="#saved-jobs-view" role="button" class="custom-toltip">
                <span class="fa fa-eye"></span>
                <span class="custom-toltip-block">Veiw</span>
              </a>
              <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Delete">
                <i class="fa fa-trash-alt"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td>Web Developer</td>
            <td>As promised, we’re the most professional..</td>
            <td>Weekly</td>
            <td>
              <a data-bs-toggle="modal" href="#saved-jobs-view" role="button" class="custom-toltip">
                <span class="fa fa-eye"></span>
                <span class="custom-toltip-block">Veiw</span>
              </a>
              <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Delete">
                <i class="fa fa-trash-alt"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td>Web Designer</td>
            <td>Custom web design solutions websites..</td>
            <td>28/06/2023</td>
            <td>
              <a data-bs-toggle="modal" href="#saved-jobs-view" role="button" class="custom-toltip">
                <span class="fa fa-eye"></span>
                <span class="custom-toltip-block">Veiw</span>
              </a>
              <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Delete">
                <i class="fa fa-trash-alt"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td>Web Developer</td>
            <td>A strategic approach to website design..</td>
            <td>28/06/2023</td>
            <td>
              <a data-bs-toggle="modal" href="#saved-jobs-view" role="button" class="custom-toltip">
                <span class="fa fa-eye"></span>
                <span class="custom-toltip-block">Veiw</span>
              </a>
              <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Delete">
                <i class="fa fa-trash-alt"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>