<?php require APPROOT . '/views/inc/mod_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">

        <main class="table table-bordered" id="customersTable">
            <section class="table__header">



            </section>
            <section class="table__body table-bordered">
                <table>
                    <thead>

                        <tr>
                            <th> Reported Person </th>
                            <th> Reported Job </th>
                            <th> Job Publisher </th>
                            <th> Reason </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['disputes'] as $dispute) : ?>
                            <tr>
                                <td><a href="<?php echo URLROOT . '/candidates/profile/' . $dispute->seeker_id ?>" target="_blank" style="display: inline-block; padding: 6px 12px; background-color: #17a2b8; color: #fff; border-radius: 20px;"><i class="fas fa-user"></i> View Profile</a></td>
                                <td><a href="<?php echo URLROOT . '/jobs/detail/' . $dispute->job_id ?>" target="_blank" style="display: inline-block; padding: 6px 12px; background-color: #28a745; color: #fff; border-radius: 20px;"><i class="fas fa-briefcase"></i> View Job</a></td>
                                <td><a href="<?php echo URLROOT . '/recruiters/public_profile/' . $dispute->recruiter_id ?>" target="_blank" style="display: inline-block; padding: 6px 12px; background-color: #ffc107; color: #212529; border-radius: 20px;"><i class="fas fa-user-tie"></i> View Recruiter</a></td>
                                <td style="font-size: 14px;"><?php echo $dispute->reason ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </section>
        </main>
    </div>
</div>

<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>





<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>