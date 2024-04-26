<?php require APPROOT . '/views/inc/pay_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12" style="margin-top: 10%">
    <div class="twm-tabs-style-1 myclass">
        <div class="tab-content" id="myTab3Content">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Monthly">
                <div class="pricing-block-outer">
                    <div class="row justify-content-center">

                        <div class="p-table-highlight m-b30">
                            <div class="pricing-table-1 circle-yellow">
                                <div class="p-table-recommended">Recommended</div>
                                <div class="p-table-title">
                                    <h4 class="wt-title">
                                        Standard
                                    </h4>
                                </div>
                                <div class="p-table-inner">

                                    <div class="p-table-price">
                                        <span>LKR 1500 / </span>
                                        <p>Monthly</p>
                                    </div>
                                    <div class="p-table-list">
                                        <ul>
                                            <li style="margin-top: 1rem;"><i class="fas fa-check-circle"></i>Jobs marked as verified</li> <!-- Added margin -->
                                            <li style="margin-top: 1rem;"><i class="fas fa-check-circle"></i>Your Jobs will be recommended more often</li> <!-- Added margin -->
                                            <li style="margin-top: 1rem;"><i class="fas fa-check-circle"></i>Search results prioritize verified recruiters</li> <!-- Added margin -->
                                        </ul>
                                    </div>
                                    <div class="p-table-btn">
                                        <div class="site-button" onclick="pay();">Purchase Now</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    payhere.onCompleted = function onCompleted() {
        // Create a FormData object and append the data you want to send
        var formData = new FormData();
        formData.append('status', 'ok');
        // Make a POST request using the fetch API
        fetch('<?= URLROOT ?>/student/purchase_premium', {
                method: 'POST',
                body: formData,
                // Add any headers if needed (e.g., content-type)
            })
            .then(response => response.json())
            .then(data => {
                if (data.message == 'ok') {
                    window.location.href = "<?= URLROOT ?>/student";
                }
            })
    };
    payhere.onDismissed = function onDismissed() {
        console.log("Payment dismissed");
    };
    payhere.onError = function onError(error) {
        console.log("Error:" + error);
    };
    var payment = <?php echo  $data['price']; ?>;

    function pay() {
        payhere.startPayment(payment);
    }
</script>
<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>