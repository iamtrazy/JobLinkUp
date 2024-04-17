<?php require APPROOT . '/views/inc/seeker_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
  <div class="twm-right-section-panel candidate-save-job site-bg-gray">
    <div class="twm-D_table table-responsive">
      <div id="jobs_bookmark_table_wrapper" class="dataTables_wrapper dt-bootstrap5">
        <div class="row">
          <div class="col-sm-12">
            <table id="jobs_bookmark_table" class="table table-bordered twm-candidate-save-job-list-wrap dataTable" aria-describedby="jobs_bookmark_table_info">
              <thead>
                <tr>
                  <th class="sorting sorting_asc" tabindex="0" aria-controls="jobs_bookmark_table" rowspan="1" colspan="1" style="width: 309.317px" aria-sort="ascending" aria-label="Job Title: activate to sort column descending">
                    Job Title
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="jobs_bookmark_table" rowspan="1" colspan="1" style="width: 166.05px" aria-label="Company: activate to sort column ascending">
                    Job Type
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="jobs_bookmark_table" rowspan="1" colspan="1" style="width: 91.5667px" aria-label="Date: activate to sort column ascending">
                    Date
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="jobs_bookmark_table" rowspan="1" colspan="1" style="width: 62.5667px" aria-label="Action: activate to sort column ascending">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['wishlist'] as $wishlist) : ?>
                  <tr class="odd">
                    <td class="sorting_1">
                      <div class="twm-candidate-save-job-list">
                        <div class="twm-media">
                          <div class="twm-media-pic">
                            <img src="<?php echo URLROOT ?>/img/pic1.jpg" alt="#" />
                          </div>
                        </div>
                        <div class="twm-mid-content">
                          <a href="#" class="twm-job-title">
                            <h4><?php echo $wishlist->topic; ?></h4>
                          </a>
                        </div>
                      </div>
                    </td>
                    <td>
                      <?php echo $wishlist->type; ?>
                    </td>
                    <td>
                      <div><?php echo $wishlist->created_at; ?></div>
                    </td>
                    <td>
                      <div class="twm-table-controls">
                        <ul class="twm-DT-controls-icon list-unstyled">
                          <li>
                            <a href="<?php echo URLROOT ?>/jobseekers/wishlist/<?php echo $wishlist->id ?>/delete">
                              <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete">
                                <span class="far fa-trash-alt"></span>
                              </button>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>