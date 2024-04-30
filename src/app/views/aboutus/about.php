<?php require APPROOT . '/views/inc/guest_header.php'; ?>
<h1><?php echo $data['title']; ?></h1>

<div class="col-lg-9 col-md-12 snipcss-h2ttD">
  <div class="blog-post-single-outer">
    <div class="blog-post-single bg-white">
      <div class="wt-post-info">
        <div class="wt-post-media m-b30">
          <img src="https://thewebmax.org/jobzilla/images/blog/blog-single/1.jpg" alt="">
        </div>
        <div class="wt-post-title ">
          <h3 class="post-title">About Us</h3>
        </div>
        <div class="wt-post-discription">
          <p>Welcome to Job Link Up, your premier destination for connecting job seekers with part-time employment opportunities! At Job Link Up, we've built a comprehensive web-based platform designed to streamline the process of finding, applying for, and securing part-time jobs.  </p>
          <p> Our mission is simple: to provide a user-friendly and efficient interface that empowers job seekers to discover rewarding part-time employment opportunities while assisting employers in finding the perfect candidates to fill their positions. </p>
          <p>With Job Link Up, job seekers gain access to a wide range of part-time job listings from reputable employers across various industries. Our intuitive search and filtering tools make it easy to narrow down options based on location, industry, schedule, and more. Once you've found the perfect opportunity, our seamless application process puts you on the path to success.</p>
          <p>For employers, Job Link Up offers a platform to connect with a diverse pool of qualified candidates actively seeking part-time employment. Our robust features allow employers to post job listings, manage applications, and efficiently communicate with potential hires, streamlining the hiring process and saving valuable time.</p>
          <p>Whether you're a job seeker looking for flexibility or an employer in need of talented part-time staff, Job Link Up is here to bridge the gap and facilitate meaningful connections. Join us today and take the next step towards achieving your employment goals!</p>
        </div>
      </div>
    </div>
    <div class="post-area-tags-wrap">
      <div class="post-social-icons-wrap">
        <h4 class="mb-4">Share</h4>
        <ul class="post-social-icons">
          <li><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
          <li><a href="javascript:void(0);" class="fab fa-twitter"></a></li>
          <li><a href="javascript:void(0);" class="fab fa-linkedin-in"></a></li>
          <li><a href="javascript:void(0);" class="fab fa-google"></a></li>
        </ul>
      </div>
</div>
    <div class="clear" id="comment-list">
      <div class="comments-area" id="comments">
        <h3 class="section-head-small mb-4">Comments</h3>
        <div>
          <ol class="comment-list">
            <li class="comment">
              <div class="comment-body">
                <div class="comment-author">
                  <img class="avatar photo" src="https://thewebmax.org/jobzilla/images/blog/comment/pic1.jpg" alt="">
                  <div class="comment-meta">
                    <a href="javascript:void(0);">Apr 05, 2023</a>
                  </div>
                </div>
                <div class="comment-info">
                  <cite class="fn">Richard Anderson</cite>
                  <div class="reply">
                    <a href="javscript:;" class="comment-reply-link">Reply</a>
                  </div>
                  <p>No one rejects, dislikes, or avoids pleasure itself, because pleasure, but because those who do not know how to pursue. </p>
                </div>
              </div>
            </li>
            <li class="comment">
              <div class="comment-body">
                <div class="comment-author">
                  <img class="avatar photo" src="https://thewebmax.org/jobzilla/images/blog/comment/pic2.jpg" alt="">
                  <div class="comment-meta">
                    <a href="javascript:void(0);">Apr 08, 2023</a>
                  </div>
                </div>
                <div class="comment-info">
                  <cite class="fn">Devid Abraham</cite>
                  <div class="reply">
                    <a href="javscript:;" class="comment-reply-link">Reply</a>
                  </div>
                  <p>No one rejects, dislikes, or avoids pleasure itself, because pleasure, but because those who do not know how to pursue. </p>
                </div>
              </div>
            </li>
          </ol>
          <div class="comment-respond m-t30" id="respond">
            <h3 class="comment-reply-title section-head-small mb-4" id="reply-title">Leave a reply <small>
                <a href="#" id="cancel-comment-reply-link" rel="nofollow" class="style-nULkq">Cancel reply</a>
              </small>
            </h3>
            <form class="comment-form" id="commentform" method="post">
              <div class="row">
                <div class="comment-form-author col-md-6 mb-3">
                  <label>Your Name* <span class="required">*</span></label>
                  <input class="form-control" type="text" value="" name="user-comment" placeholder="Your Name*" id="author">
                </div>
                <div class="comment-form-email col-md-6 mb-3">
                  <label>Your Email* <span class="required">*</span></label>
                  <input class="form-control" type="text" value="" name="email" placeholder="Your Email*">
                </div>
                <div class="comment-form-comment col-md-12 mb-4">
                  <label>Message*</label>
                  <textarea class="form-control" rows="8" name="comment" placeholder="Message*" id="comment"></textarea>
                </div>
                <div class="form-submit">
                  <button type="submit" class="site-button">Submit Now</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>