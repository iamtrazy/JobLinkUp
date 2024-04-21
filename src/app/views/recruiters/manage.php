<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>

<div class="section-full p-t120  p-b90 site-bg-white">
  <div class="container"style="transform: none;">
    <div class="row" style="transform: none;">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
                            <!--Filter Short By-->
                            <div class="twm-right-section-panel site-bg-gray">
                                <form>
                                    <!--Basic Information-->
                                    <div class="panel panel-default">
                                        <div class="panel-heading wt-panel-heading p-a20">
                                            <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i>Manage jobs</h4>
                                        </div>
                                        <div class="panel-body wt-panel-body m-b30 ">
                                            <div class="twm-D_table p-a20 table-responsive">
                                                <div id="jobs_bookmark_table_wrapper" class="dataTables_wrapper dt-bootstrap5"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="jobs_bookmark_table_length"><label>Show <select name="jobs_bookmark_table_length" aria-controls="jobs_bookmark_table" class="form-select form-select-sm"><option value="3">3</option><option value="5">5</option><option value="10">10</option><option value="-1">All</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="jobs_bookmark_table_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="jobs_bookmark_table"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="jobs_bookmark_table" class="table table-bordered twm-bookmark-list-wrap dataTable" aria-describedby="jobs_bookmark_table_info">
                                                    <thead>
                                                        <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="jobs_bookmark_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Job Title: activate to sort column descending" style="width: 144.365px;">Job Title</th><th class="sorting" tabindex="0" aria-controls="jobs_bookmark_table" rowspan="1" colspan="1" aria-label="Category: activate to sort column ascending" style="width: 88.6875px;">Category</th><th class="sorting" tabindex="0" aria-controls="jobs_bookmark_table" rowspan="1" colspan="1" aria-label="Job Types: activate to sort column ascending" style="width: 86.3646px;">Job Types</th><th class="sorting" tabindex="0" aria-controls="jobs_bookmark_table" rowspan="1" colspan="1" aria-label="Applications: activate to sort column ascending" style="width: 94.2292px;">Applications</th><th class="sorting" tabindex="0" aria-controls="jobs_bookmark_table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 45.625px;">Date</th><th class="sorting" tabindex="0" aria-controls="jobs_bookmark_table" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 49.5625px;">Action</th></tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($data['jobs'] as $jobs) : ?>
                                                        
                                                        
                                                        
                                                    <tr class="odd">
                                                            <td class="sorting_1">
                                                                <div class="twm-bookmark-list">
                                                                    
                                                                    <div class="twm-mid-content">
                                                                        <a href="#" class="twm-job-title">
                                                                            <h4><?php echo $jobs->topic;?>
                                                                                </h4>
                                                                            <p class="twm-bookmark-address">
                                                                                <i class="feather-map-pin"></i>$jobs->location
                                                                            </p>
                                                                        </a>
                                                                        
                                                                    </div>
                                                                    
                                                                </div>
                                                            </td>
                                                            <td><?php echo $applications->category; ?>
                                                                $jobModel->getJobs()->$category</td>
                                                            <td><div class="twm-jobs-category"><span class="twm-bg-sky"><wdautohl-customtag style="font-weight:bold;color:red;font-size:inherit;display:inline;" id="wdautohl_id_1" class="wdautohl_ZnJlZWxhbmNlcg__">Freelancer</wdautohl-customtag></span></div></td>
                                                            <td><a href="javascript:;" class="site-text-primary">$jobModel->getApplications()->$rowcount</a></td>
                                                            <td>
                                                                <span class="text-clr-green2">$jobmodel->$status</span>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="twm-table-controls">
                                                                    <ul class="twm-DT-controls-icon list-unstyled">
                                                                        <li>
                                                                            <button title="" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View profile">
                                                                                <span class="fa fa-eye"></span>
                                                                            </button>
                                                                        </li>
                                                                        
                                                                        <li>
                                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete">
                                                                                <span class="far fa-trash-alt"></span>
                                                                            </button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr><tr class="even">
                                                            <td class="sorting_1">
                                                                <div class="twm-bookmark-list">
                                                                    
                                                                    <div class="twm-mid-content">
                                                                        <a href="#" class="twm-job-title">
                                                                            <h4><?php echo $job->type; ?>IT Department Manager</h4>
                                                                            <p class="twm-bookmark-address">
                                                                                <i class="feather-map-pin"></i>$jobs->location
                                                                            </p>
                                                                        </a>
                                                                        
                                                                    </div>
                                                                    
                                                                </div>
                                                            </td>
                                                            <td>PHP Developer</td>
                                                            <td><div class="twm-jobs-category"><span class="twm-bg-purple">Fulltime</span></div></td>
                                                            <td><a href="javascript:;" class="site-text-primary">06 Applied</a></td>
                                                            <td>
                                                                <span class="text-clr-red">Reject</span>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="twm-table-controls">
                                                                    <ul class="twm-DT-controls-icon list-unstyled">
                                                                        <li>
                                                                            <button title="" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View profile">
                                                                                <span class="fa fa-eye"></span>
                                                                            </button>
                                                                        </li>
                                                                        
                                                                        <li>
                                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete">
                                                                                <span class="far fa-trash-alt"></span>
                                                                            </button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr><tr class="odd">
                                                            <td class="sorting_1">
                                                                <div class="twm-bookmark-list">
                                                                    
                                                                    <div class="twm-mid-content">
                                                                        <a href="#" class="twm-job-title">
                                                                            <h4><wdautohl-customtag style="font-weight:bold;color:red;font-size:inherit;display:inline;" id="wdautohl_id_2" class="wdautohl_cmVjcmVhdGlvbg__">Recreation</wdautohl-customtag> &amp; Fitness Worker</h4>
                                                                            <p class="twm-bookmark-address">
                                                                                <i class="feather-map-pin"></i>Sacramento, California
                                                                            </p>
                                                                        </a>
                                                                        
                                                                    </div>
                                                                    
                                                                </div>
                                                            </td>
                                                            <td>Gym Trainer</td>
                                                            <td><div class="twm-jobs-category"><span class="twm-bg-golden">Temporary</span></div></td>
                                                            <td><a href="javascript:;" class="site-text-primary">08 Applied</a></td>
                                                            <td>
                                                                <span class="text-clr-yellow">Pending</span>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="twm-table-controls">
                                                                    <ul class="twm-DT-controls-icon list-unstyled">
                                                                        <li>
                                                                            <button title="" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View profile">
                                                                                <span class="fa fa-eye"></span>
                                                                            </button>
                                                                        </li>
                                                                        
                                                                        <li>
                                                                            <button title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete">
                                                                                <span class="far fa-trash-alt"></span>
                                                                            </button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>

                                                    </tbody>
                                                    
                                                </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="jobs_bookmark_table_info" role="status" aria-live="polite">Showing 1 to 3 of 7 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="jobs_bookmark_table_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="jobs_bookmark_table_previous"><a href="#" aria-controls="jobs_bookmark_table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="jobs_bookmark_table" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="jobs_bookmark_table" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="jobs_bookmark_table" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item next" id="jobs_bookmark_table_next"><a href="#" aria-controls="jobs_bookmark_table" data-dt-idx="4" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                                            </div>             
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
    </div>
  </div>
</div>