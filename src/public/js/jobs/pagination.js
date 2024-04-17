$(document).ready(function () {
  var currentPage = 1;
  var perPage = 10; // Default number of jobs per page

  loadJobs(currentPage, perPage);

  $(".product-filter-wrap select[data-bv-field='category']").change(function () {
    var selectedOption = $(this).val();
    var sortBy = "created_at"; // Default sorting by created_at
    if (selectedOption === "Category") {
      sortBy = "category";
    }
    var currentPage = 1; // Assuming we always start from page 1 when sorting changes
    loadJobs(currentPage, perPage, sortBy);
  });

  // Pagination click event for previous page
  $(".pagination-outer").on("click", ".prev", function (e) {
    e.preventDefault();
    if (currentPage > 1) {
      currentPage--;
      loadJobs(currentPage, perPage);
    }
  });

  // Pagination click event for next page
  $(".pagination-outer").on("click", ".next", function (e) {
    e.preventDefault();
    currentPage++;
    loadJobs(currentPage, perPage);
  });

  // Pagination click event for specific page
  $(".pagination-outer").on("click", "a.page-link", function (e) {
    e.preventDefault();
    var page = parseInt($(this).text());
    if (!isNaN(page)) {
      currentPage = page;
      loadJobs(currentPage, perPage);
    }
  });

  // Event handler for changing number of jobs per page
  $(".product-filter-wrap select[data-bv-field='size']").change(function () {
    perPage = parseInt($(this).val());
    currentPage = 1; // Reset to first page
    loadJobs(currentPage, perPage);
  });

  function loadJobs(page, perPage, sortBy) {
    $.ajax({
      url: "api/jobs/" + page + "/" + perPage + "/" + sortBy, // Pass perPage as query parameter
      type: "GET",
      success: function (response) {
        $("#jobs").html(response);

        // Update pagination links
        fetchTotalJobsCount();
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  // Function to fetch total job count
  function fetchTotalJobsCount() {
    $.ajax({
      url: "api/jobcount",
      type: "GET",
      dataType: "json",
      success: function (response) {
        updatePagination(response.total_jobs);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  // Function to update pagination links
  function updatePagination(totalJobs) {
    var totalPages = Math.ceil(totalJobs / perPage);

    // Clear existing pagination links
    $(".pagination-list").empty();

    // Add previous page link
    $(".pagination-list").append(
      '<li class="prev"><a href="#"><span><i class="fa fa-angle-left"></i></span></a></li>'
    );

    // Add page links
    for (var i = 1; i <= totalPages; i++) {
      var activeClass = i === currentPage ? "active" : "";
      $(".pagination-list").append(
        '<li class="' +
          activeClass +
          '"><a href="#" class="page-link">' +
          i +
          "</a></li>"
      );
    }

    // Add next page link
    $(".pagination-list").append(
      '<li class="next"><a href="#"><span><i class="fa fa-angle-right"></i></span></a></li>'
    );

    // Update number of jobs shown
    $(".woocommerce-result-count-left").text("Showing " + perPage + " jobs");
  }
});
