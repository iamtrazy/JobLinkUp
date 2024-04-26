<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">
        <form>
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i>Manage jobs</h4>
                </div>
                <div class="panel-body wt-panel-body m-b30 ">
                    <div class="twm-D_table p-a20 table-responsive">
                        <table id="jobs_bookmark_table" class="table table-bordered twm-bookmark-list-wrap">
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th>Job Types</th>
                                    <th>Rate</th>
                                    <th>Applications</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['jobs'] as $job) : ?>
                                    <tr>
                                        <td>
                                            <div class="twm-bookmark-list">
                                                <div class="twm-mid-content">
                                                    <a href="#" class="twm-job-title">
                                                        <h4><?php echo $job->topic ?></h4>
                                                        <p class="twm-bookmark-address">
                                                            <i class="fas fa-map-marker-alt"></i><?php echo $job->location; ?>
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo $job->type; ?></td>
                                        <td>
                                            <?php echo $job->rate ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary"><?php echo $job->appliedCount; ?></span>
                                            <a href="<?php echo URLROOT . '/recruiters/applications/' . $job->id ?>" class="view-applicants" style="margin-left: 10px;">
                                                View Applicants
                                            </a>
                                        </td>
                                        <td>
                                            <span class="text-clr-green2"><?php echo time_elapsed_string($job->created_at); ?></span>
                                        </td>
                                        <td>
                                            <div class="twm-table-controls">
                                                <ul class="twm-DT-controls-icon list-unstyled">
                                                    <li>
                                                        <button title="Edit Job" type="button" data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <a href="<?php echo URLROOT . '/recruiters/editjob/' . $job->id ?>">
                                                                <span class="fa fa-edit"></span>
                                                            </a>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button title="Remove Job" data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <a href="<?php echo URLROOT . '/recruiters/deletejob/' . $job->id ?>">
                                                                <span class="far fa-trash-alt"></span>
                                                            </a>
                                                        </button>
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
        </form>
    </div>
</div>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>