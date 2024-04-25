<?php foreach ($data['candidates'] as $seeker) :

    $city = $seeker->city == "unknown" ? "" : $seeker->city;
    $country = $seeker->country == "unknown" ? "" : $seeker->country;

    $address = "";

    if (!empty($city) && !empty($country)) {
        $address = $city . ", " . $country;
    } elseif (!empty($city)) {
        $address = $city;
    } elseif (!empty($country)) {
        $address = $country;
    } else {
        $address = "Unknown";
    }
?>
    <div class="col-lg-6 col-md-6">
        <div class="twm-candidates-grid-style1 mb-5">
            <div class="twm-media">
                <div class="twm-media-pic">
                    <img src="<?php echo URLROOT . '/img/profile/' . $seeker->profile_image ?>" alt="">
                </div>
            </div>
            <div class="twm-mid-content">
                <a href="candidate-detail.html" class="twm-job-title">
                    <h4> <?php echo $seeker->username; ?> </h4>
                </a>
                <div class="mid-mid-content">
                    <a href="<?php echo URLROOT . '/candidates/profile/' . $seeker->id ?>" class="twm-view-prifile site-text-primary">View Profile</a>
                    <?php
                    if (isset($seeker->cv)) {
                        echo '<a href="' . URLROOT . '/assets/cvs/' . $seeker->cv . '" target="_blank" class="twm-download-resume site-text-primary"> View Resume</a>';
                    } ?>
                </div>
                <div class="twm-fot-content">
                    <div class="twm-left-info">
                        <p class="twm-candidate-address"> <?php echo '<i class="fas fa-map-marker-alt"></i>' . $address; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>