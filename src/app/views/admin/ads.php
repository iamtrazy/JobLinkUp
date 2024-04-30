<?php require APPROOT . '/views/inc/admin_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <div class="twm-right-section-panel site-bg-gray">
        <form id="form1"> <!-- Added ID to the first form -->
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">Ads / Notices in Jobs Section</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <div class="ls-inputicon-box">
                                    <input id="title1" class="form-control" name="title1" type="text" placeholder="Title of the Ad" minlength="2" maxlength="255" />
                                    <i class="fs-input-icon fa fa-certificate"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Website</label>
                                <div class="ls-inputicon-box">
                                    <input id="url1" class="form-control" name="url1" type="text" placeholder="https://example.net" minlength="5" maxlength="255" />
                                    <i class="fs-input-icon fa fa-globe-americas"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="about1"> Ad Text</label>
                                    <textarea id="about1" class="form-control" name="text1" rows="3" minlength="2" maxlength="255" placeholder="Enter the Ad content"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label> Choose a Color</label>
                            <input id="colorPicker1" type="text" class="form-control" name="color1" />
                        </div>
                        <input type="hidden" id="colorValue1" name="colorValue1" />
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

        </form>
        <form id="form2"> <!-- Added ID to the second form -->
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">Ads / Notices in Candidate Section</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <div class="ls-inputicon-box">
                                    <input id="title2" class="form-control" name="title2" type="text" placeholder="Title of the Ad" minlength="2" maxlength="255" />
                                    <i class="fs-input-icon fa fa-certificate"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Website</label>
                                <div class="ls-inputicon-box">
                                    <input id="url2" class="form-control" name="url2" type="text" placeholder="https://example.net" minlength="5" maxlength="255" />
                                    <i class="fs-input-icon fa fa-globe-americas"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="about2"> Ad Text</label>
                                    <textarea id="about2" class="form-control" name="text2" rows="3" minlength="2" maxlength="255" placeholder="Enter the Ad content"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label> Choose a Color</label>
                            <input id="colorPicker2" type="text" class="form-control" name="color2" />
                        </div>
                        <input type="hidden" id="colorValue2" name="colorValue2" />
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
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        function populateJobAdForm() {
            $.get('<?php echo URLROOT; ?>/admins/job_ad', function(data) {
                // Check if data is valid
                if (data && data.job_ad) {
                    var jobAd = data.job_ad;
                    // Populate form fields with job ad data
                    $('#title1').val(jobAd.title);
                    $('#url1').val(jobAd.url);
                    $('#about1').val(jobAd.text);
                    $('#colorPicker1').spectrum("set", jobAd.color); // Set colorpicker value
                    $('#colorValue1').val(jobAd.color);
                }
            });
        }

        // Call populateJobAdForm function when the document is ready
        populateJobAdForm();

        function populateCandidateAdForm() {
            $.get('<?php echo URLROOT; ?>/admins/candidate_ad', function(data) {
                if (data && data.candidate_ad) {
                    var candidateAd = data.candidate_ad;
                    // Populate form fields with candidate ad data
                    $('#title2').val(candidateAd.title);
                    $('#url2').val(candidateAd.url);
                    $('#about2').val(candidateAd.text);
                    $('#colorPicker2').spectrum("set", candidateAd.color); // Set colorpicker value
                    $('#colorValue2').val(candidateAd.color);
                }
            });
        }

        // Call populateCandidateAdForm function when the document is ready
        populateCandidateAdForm();
        // Initialize Spectrum Colorpicker for the first form
        $('#colorPicker1').spectrum({
            preferredFormat: "hex", // Set preferred format to hexadecimal
            showInput: true, // Show the input box
            showPalette: true, // Show the palette
            palette: [ // Define the palette colors
                ["#000", "#fff", "#ff0000", "#00ff00", "#0000ff"]
            ],
            change: function(color) {
                // Update the value of the hidden input field
                $('#colorValue1').val(color.toHexString());
            }
        });

        // Initialize Spectrum Colorpicker for the second form
        $('#colorPicker2').spectrum({
            preferredFormat: "hex", // Set preferred format to hexadecimal
            showInput: true, // Show the input box
            showPalette: true, // Show the palette
            palette: [ // Define the palette colors
                ["#000", "#fff", "#ff0000", "#00ff00", "#0000ff"]
            ],
            change: function(color) {
                // Update the value of the hidden input field
                $('#colorValue2').val(color.toHexString());
            }
        });

        function submitForm(adId) {
            // Prepare the data to be sent in the POST request
            var formData = {
                title: $('#title' + adId).val(),
                text: $('#about' + adId).val(),
                url: $('#url' + adId).val(),
                color: $('#colorValue' + adId).val(),
                ad_id: adId
            };

            // Send POST request to the API endpoint
            $.post('/admins/post_ads', formData)
                .done(function(data) {
                    // Check for success or error message
                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'Success',
                            text: data.message,
                            icon: 'success'
                        }).then(() => {
                            // Reload the page or perform any other action
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error'
                        });
                    }
                })
                .fail(function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to update ad. Please try again later.',
                        icon: 'error'
                    });
                });
        }

        // Event listener for the first form's submit button
        $('#form1').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update this ad.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Call submitForm function with ad_id 1
                    submitForm(1);
                }
            });
        });

        // Event listener for the second form's submit button
        $('#form2').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update this ad.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Call submitForm function with ad_id 2
                    submitForm(2);
                }
            });
        });
    });
</script>
<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>