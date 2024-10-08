<?php require APPROOT . '/views/inc/seeker_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
  <div class="twm-right-section-panel site-bg-gray">
    <div class="wt-admin-dashboard-msg-2 twm-dashboard-style-2">
      <div class="wt-dashboard-msg-user-list">
        <div class="user-msg-list-btn-outer">
          <button class="user-msg-list-btn-close">Close</button>
          <button class="user-msg-list-btn-open">
            User Message
          </button>
        </div>
        <div class="scroll-wrapper wt-dashboard-msg-search-list scrollbar-macosx" style="position: relative">
          <div id="msg-list-wrap" class="wt-dashboard-msg-search-list scrollbar-macosx scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 700px; overflow-x: hidden;">
            <!-- threads appear here dynamically -->
          </div>
        </div>
      </div>
      <div class="wt-dashboard-msg-box">
        <div class="single-msg-user-name-box">
          <div class="single-msg-short-discription">
            <h4 class="single-msg-user-name">
              Welcome to the JobLinkUp chat portal.
            </h4>
            <div class="single-msg-business-name">
              Select a recruiter from the left thread to start chat.</div>
          </div>
        </div>
        <div class="scroll-wrapper single-user-msg-conversation scrollbar-macosx" style="position: relative">
          <div id="msg-chat-wrap" class="single-user-msg-conversation scroll-y" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 550px; overflow-x: hidden; ">
            <div class="single-user-comment-wrap">
              <div class="row">
                <div class="col-xl-9 col-lg-12">
                  <div class="single-user-comment-block clearfix">
                    <div class="single-user-com-pic">
                      <img src="https://joblinkup.com/img/pic4.jpg" alt="" />
                    </div>
                    <div class="single-user-com-text">
                      Whoa 😮😮 !! how did i get here
                    </div>
                    <!-- <div class="single-user-msg-time">
                      msg date should appear here
                    </div> -->
                  </div>
                </div>
              </div>
            </div>

            <div class="single-user-comment-wrap sigle-user-reply">
              <div class="row justify-content-end">
                <div class="col-xl-9 col-lg-12">
                  <div class="single-user-comment-block clearfix">
                    <div class="single-user-com-pic">
                      <img src="https://joblinkup.com/img/pic1.jpg" alt="" />
                    </div>
                    <div class="single-user-com-text">
                      Welcome to the JobLinkUp 👏 ! Your portal for part time job needs.🪅
                    </div>
                    <!-- <div class="single-user-msg-time">
                      msg date should appear here
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="single-msg-reply-comment">
          <div class="input-group">
            <textarea class="form-control" placeholder="Type a message here"></textarea>
            <button class="btn" type="button">
              <i class="fa fa-paper-plane"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    var img='';
    // Function to load messages for a specific thread
    function loadMessages(threadId, recruiterName) {
      // Function to send a message
      function sendMessage() {
        var message = $('.form-control').val(); // Get the message from the input field
        $.ajax({
          url: '<?php echo URLROOT . '/api/chat_send_message/' ?>' + threadId,
          type: 'POST',
          dataType: 'json',
          data: {
            text: message // Send the message in the POST request
          },
          success: function(response) {
            // Reload messages after sending the message
            loadMessages(threadId, recruiterName);
            // Clear input field after sending the message
            $('.form-control').val('');
          },
          error: function(xhr, status, error) {
            console.error("Error sending message:", error);
          }
        });
      }

      // Clear existing messages
      $('#msg-chat-wrap').empty();
      // Iterate over each message in the response
      $.ajax({
        url: '<?php echo URLROOT . '/api/chat_thread_messages/' ?>' + threadId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          if (response && response.length > 0) {
            // Iterate over each message in the response
            $.each(response, function(index, message) {
              // Determine message class based on whether it's a reply or not
              var messageClass = message.reply ? 'single-user-comment-wrap sigle-user-reply' : 'single-user-comment-wrap';
              var rowClass = message.reply ? 'row justify-content-end' : 'row';
              var profileImage = message.reply ? `https://joblinkup.com/img/profile/${img}` : `https://joblinkup.com/img/profile/<?php echo $data['profile_image']?>`;
              // Create HTML elements for each message and append to container
              var messageHtml = `
                        <div class="${rowClass}">
                            <div class="col-xl-9 col-lg-12">
                                <div class="${messageClass} clearfix">
                                    <div class="single-user-com-pic">
                                        <img src="${profileImage}" alt="" />
                                    </div>
                                    <div class="single-user-com-text">
                                        ${message.text}
                                    </div>
                                    <div class="single-user-msg-time">
                                        ${message.created_at}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
              $('#msg-chat-wrap').append(messageHtml);
            });
            // Hide horizontal scrollbar for messages
            $('#msg-chat-wrap').css('overflow-x', 'hidden');
          } else {
            // If there are no messages, display a message
            $('#msg-chat-wrap').html('<p>No messages available</p>');
          }
        },
        error: function(xhr, status, error) {
          console.error("Error fetching chat messages:", error);
        }
      });

      // Update recruiter name and business name in conversation box
      $('.single-msg-user-name').text(recruiterName);

      // Unbind previous event listeners before attaching new ones
      $('button.btn').off('click').on('click', function() {
        sendMessage();
      });

      $('.form-control').off('keypress').on('keypress', function(event) {
        if (event.which === 13) {
          sendMessage();
        }
      });
    }

    // Ajax call to fetch chat threads from the API
    $.ajax({
      url: '<?php echo URLROOT . '/api/chat_threads' ?>',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        img = response[0].profile_image;
        if (response && response.length > 0) {
          // Iterate over each chat thread in the response
          $.each(response, function(index, thread) {
            // Create HTML elements for each chat thread and append to container
            var threadHtml = `
                    <div class="wt-dashboard-msg-search-list-wrap" data-thread-id="${thread.thread_id}">
                        <div class="msg-user-info clearfix">
                            <div class="msg-user-timing">${thread.created_at}</div>
                            <div class="msg-user-info-pic">
                                <img src="https://joblinkup.com/img/profile/${thread.profile_image}" alt="" />
                            </div>
                            <div class="msg-user-info-text">
                                <div class="msg-user-name">${thread.recruiter_name}</div>
                                <div class="msg-user-discription">${thread.created_at}</div>
                            </div>
                        </div>
                    </div>
                `;
            $('#msg-list-wrap').append(threadHtml);
          });

          // Event listener for clicking on a thread
          $('.wt-dashboard-msg-search-list-wrap').off('click').on('click', function() {
            var threadId = $(this).data('thread-id');
            var recruiterName = $(this).find('.msg-user-name').text();
            loadMessages(threadId, recruiterName);
            // loadMessagesPeriodically(threadId, recruiterName);
          });
        } else {
          // If there are no threads, display a message
          $('#msg-list-wrap').html('<p>No threads available</p>');
        }
      },
      error: function(xhr, status, error) {
        console.error("Error fetching chat threads:", error);
      }
    });

    function loadMessagesPeriodically(threadId, recruiterName) {
      setInterval(function() {
        loadMessages(threadId, recruiterName);
      }, 3000); // 3000 milliseconds = 3 seconds
    }
  });
</script>


<?php require APPROOT . '/views/inc/seeker_footer.php'; ?>