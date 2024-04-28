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
    function handlePaymentSuccess() {
        $.post("<?php echo URLROOT ?>/recruiters/pay_success", function(data, status) {
            if (status === 'success' && data.status === 'success') {
                window.location.href = '<?php echo URLROOT ?>/recruiters/transactions';
            }
        });
    }

    payhere.onCompleted = function onCompleted() {
        handlePaymentSuccess();
    };

    payhere.onDismissed = function onDismissed() {
        console.log("Payment dismissed");
    };

    payhere.onError = function onError(error) {
        console.log("Error:" + error);
    };

    var payment = <?php echo $data['payment']; ?>;

    function pay() {
        payhere.startPayment(payment);
    }
</script>
</script>

<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>