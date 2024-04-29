<?php require APPROOT . '/views/inc/admin_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">
        <form id="dropboxForm">
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">Dropbox API Credentials</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30">
                    <div class="form-group">
                        <label for="dropboxClientId">Dropbox Client ID</label>
                        <input id="dropboxClientId" class="form-control" name="dropboxClientId" type="text" placeholder="Enter your Dropbox Client ID" value="<?php echo $data['dropbox_keys']->client_id; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="dropboxClientSecret">Dropbox Client Secret</label>
                        <div class="ls-inputicon-box">
                            <input id="dropboxClientSecret" class="form-control" name="dropboxClientSecret" type="text" placeholder="Enter your Dropbox Client Secret" value="<?php echo $data['dropbox_keys']->client_secret; ?>" required />
                            <i class="fs-input-icon fa fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dropboxAccessToken">Dropbox Access Token</label>
                        <input id="dropboxAccessToken" class="form-control" name="dropboxAccessToken" type="text" placeholder="Enter your Dropbox Access Token" value="<?php echo $data['dropbox_keys']->access_token; ?>" required />
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="text-left">
                    <button type="submit" class="site-button"><i class="fa fa-save"></i> Save Credentials</button>
                </div>
            </div>
        </form>
        <div class="m-t20">
            <p>You can create a new app for the Dropbox API here: <a href="https://www.dropbox.com/developers/apps" target="_blank">https://www.dropbox.com/developers/apps</a></p>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dropboxForm').submit(function(e) {
            e.preventDefault(); // Prevent form submission

            // Collect form data
            var formData = {
                client_id: $('#dropboxClientId').val(),
                client_secret: $('#dropboxClientSecret').val(),
                access_token: $('#dropboxAccessToken').val()
            };

            // Send POST request to the API endpoint
            $.post('/admins/dropbox', formData)
                .done(function(data) {
                    // Check for success or error status in JSON response
                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'Success',
                            text: data.message,
                            icon: 'success'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error'
                        });
                    }
                })
                .fail(function(xhr, status, error) {
                    // Handle AJAX errors
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to save Dropbox keys: ' + error,
                        icon: 'error'
                    });
                });
        });
    });
</script>

<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>