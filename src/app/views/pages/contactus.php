<?php require APPROOT . '/views/inc/header.php'; ?>
<h1><?php echo $data['title']; ?></h1>

<div class="section-content snipcss-oeZP9">
    <div class="container">
        <div class="contact-one-inner">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="contact-form-outer">
                        <div class="section-head left wt-small-separator-outer">
                            <h2 class="wt-title">Send Us a Message</h2>
                            <p>Feel free to contact us and we will get back to you as soon as we can.</p>
                        </div>
                        <form class="cons-contact-form" method="post" action="form-handler2.php">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group mb-3">
                                        <input name="username" type="text" required="" class="form-control" placeholder="Name" fdprocessedid="9iuocu">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group mb-3">
                                        <input name="email" type="text" class="form-control" required="" placeholder="Email" fdprocessedid="28dajr">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group mb-3">
                                        <input name="phone" type="text" class="form-control" required="" placeholder="Phone" fdprocessedid="yjkr8">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group mb-3">
                                        <input name="subject" type="text" class="form-control" required="" placeholder="Subject" fdprocessedid="nus2fy">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <textarea name="message" class="form-control" rows="3" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="site-button" fdprocessedid="fwwl9f">Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="contact-info-wrap">
                        <div class="contact-info">
                            <div class="contact-info-section">
                                <div class="c-info-column">
                                    <div class="c-info-icon"><i class=" fas fa-map-marker-alt"></i></div>
                                    <h3 class="twm-title">In the bay area?</h3>
                                    <p>1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                </div>
                                <div class="c-info-column">
                                    <div class="c-info-icon custome-size"><i class="fas fa-mobile-alt"></i></div>
                                    <h3 class="twm-title">Feel free to contact us</h3>
                                    <p><a href="tel:+216-761-8331">+2 900 234 4241</a></p>
                                    <p><a href="tel:+216-761-8331">+2 900 234 3219</a></p>
                                </div>
                                <div class="c-info-column">
                                    <div class="c-info-icon"><i class="fas fa-envelope"></i></div>
                                    <h3 class="twm-title">Support</h3>
                                    <p>joblinkup@gmail.com</p>
                                    <p>help.joblinkup@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>