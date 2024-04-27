<?php require APPROOT . '/views/inc/recruiter_header.php'; ?>
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <!--Filter Short By-->
    <div class="twm-right-section-panel site-bg-gray">
        <div class="wt-admin-right-page-header">
            <h2><?php echo $_SESSION['business_name'] ?></h2>
            <p></p>
        </div>

        <div class="twm-dash-b-blocks mb-5">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                    <div class="panel panel-default">
                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient">
                            <div class="wt-card-wrap-2">
                                <div class="wt-card-icon-2">
                                    <i class="fa fa-briefcase"></i>
                                </div>
                                <div class="wt-card-right wt-total-active-listing counter">
                                    <?php echo $data['total_jobs'] ?>
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Posted Jobs</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                    <div class="panel panel-default">
                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-2">
                            <div class="wt-card-wrap-2">
                                <div class="wt-card-icon-2">
                                    <i class="fa fa-tasks"></i>
                                </div>
                                <div class="wt-card-right wt-total-listing-view counter">
                                    <?php echo $data['total_applications'] ?>
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Pending Applications</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                    <div class="panel panel-default">
                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-3">
                            <div class="wt-card-wrap-2">
                                <div class="wt-card-icon-2">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="wt-card-right wt-total-listing-review counter" id="totalMessagesCounter">
                                    
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Messages</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                    <div class="panel panel-default">
                        <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-4">
                            <div class="wt-card-wrap-2">
                                <div class="wt-card-icon-2">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="wt-card-right wt-total-listing-bookmarked counter">
                                    <?php echo $data['total_views'] ?>
                                </div>
                                <div class="wt-card-bottom-2">
                                    <h4 class="m-b0">Total Job Views</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="twm-pro-view-chart-wrap">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                    <div class="panel panel-default">
                        <div class="panel-heading wt-panel-heading p-a20">
                            <h4 class="panel-tittle m-a0">Inbox</h4>
                        </div>
                        <div class="panel-body wt-panel-body bg-white">
                            <div class="scroll-wrapper dashboard-messages-box-scroll scrollbar-macosx" style="position: relative">
                                <div class="dashboard-messages-box-scroll scrollbar-macosx scroll-content scroll-scrolly_visible" style="
                                  height: auto;
                                  margin-bottom: 0px;
                                  margin-right: 0px;
                                  max-height: 394px;
                                ">
                                    <div class="dashboard-messages-box" id="inboxMessages">
                                    </div>


                                </div>
                                <div class="scroll-element scroll-x scroll-scrolly_visible">
                                    <div class="scroll-element_outer">
                                        <div class="scroll-element_size"></div>
                                        <div class="scroll-element_track"></div>
                                        <div class="scroll-bar" style="width: 0px"></div>
                                    </div>
                                </div>
                                <div class="scroll-element scroll-y scroll-scrolly_visible">
                                    <div class="scroll-element_outer">
                                        <div class="scroll-element_size"></div>
                                        <div class="scroll-element_track"></div>
                                        <div class="scroll-bar" style="height: 271px; top: 0px"></div>
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
    $(document).ready(function() {
        // Function to fetch chat threads and display messages
        function fetchChatThreadsAndMessages() {
            $.ajax({
                url: '<?php echo URLROOT . '/api/chat_threads' ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response && response.length > 0) {
                        var totalMessagesCount = 0;
                        $('#inboxMessages').empty(); // Clear previous messages
                        $.each(response, function(index, thread) {
                            var messagesCount = 0;
                            var threadHtml = `
                            <div class="dashboard-messages-box">
                                <div class="dashboard-message-avtar">
                                    <img src="https://joblinkup.com/img/profile/${thread.profile_image}" alt="" />
                                </div>
                                <div class="dashboard-message-area">
                                    <h5>${thread.seeker_name}<span>${thread.created_at}</span></h5>
                                    <p>`;
                            $.ajax({
                                url: '<?php echo URLROOT . '/api/chat_thread_messages/' ?>' + thread.thread_id,
                                type: 'GET',
                                dataType: 'json',
                                async: false, // Ensure synchronous request
                                success: function(messages) {
                                    if (messages && messages.length > 0) {
                                        $.each(messages, function(i, message) {
                                            if (message.reply) {
                                                messagesCount++;
                                                var profileImage = `https://joblinkup.com/img/profile/${thread.profile_image}`;
                                                var messageHtml = `
                                                <div class="single-message">
                                                </div>
                                            `;
                                                threadHtml += messageHtml;
                                            }
                                        });
                                    }
                                }
                            });
                            threadHtml += `</p>
                                    <p>${messagesCount} New Message(s)</p>
                                </div>
                            </div>`;
                            $('#inboxMessages').append(threadHtml);
                            totalMessagesCount += messagesCount;
                        });
                        $('#totalMessagesCounter').text(totalMessagesCount); // Update total messages count
                    } else {
                        $('#inboxMessages').html('<p>No threads available</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching chat threads:", error);
                }
            });
        }

        // Fetch chat threads and messages when the page loads
        fetchChatThreadsAndMessages();

        // Fetch chat threads and messages periodically
        setInterval(fetchChatThreadsAndMessages, 3000); // 3000 milliseconds = 3 seconds
    });
</script>


<?php require APPROOT . '/views/inc/recruiter_footer.php'; ?>