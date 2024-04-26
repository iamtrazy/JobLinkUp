
$(document).ready(function() {
    // Add a click event handler to all delete buttons with dynamically set IDs
    $(".deleteJobByJobId").click(function() {
        // Get the ID of the record you want to delete from the button's ID attribute
        var jobId = $(this).attr("id");

        // Make an AJAX request to your server to delete the record
        $.ajax({
            type: "POST",
            url: "<?php echo URLROOT; ?>/recruiters/manage", // URL to your PHP controller
            data: { id: jobId },
            success: function(response) {
                // Handle the response from the server
                alert("Job with ID " + jobId + " has been moved to trash"); // You can display a success message or handle errors here
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });
});
