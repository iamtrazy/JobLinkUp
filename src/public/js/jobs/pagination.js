$(document).ready(function () {
  var currentPage = 1;
  var perPage = 8; // Default number of jobs per page
  var selectedCategories = "all"; // Initialize selected categories

  loadJobs(currentPage, perPage, "created_at", selectedCategories);

  $(".product-filter-wrap select[data-bv-field='category']").change(
    function () {
      var selectedOption = $(this).val();
      var sortBy = "created_at"; // Default sorting by created_at
      if (selectedOption === "Category") {
        sortBy = "category";
      } else if (selectedOption === "Price") {
        sortBy = "price";
      }

      currentPage = 1; // Assuming we always start from page 1 when sorting changes
      loadJobs(currentPage, perPage, sortBy, selectedCategories);
    }
  );

  // Pagination click event for previous page
  $(".pagination-outer").on("click", ".prev", function (e) {
    e.preventDefault();
    if (currentPage > 1) {
      currentPage--;
      loadJobs(currentPage, perPage, null, selectedCategories);
    }
  });

  // Pagination click event for next page
  $(".pagination-outer").on("click", ".next", function (e) {
    e.preventDefault();
    var totalPages = Math.ceil($(".pagination-list li").length - 2); // Calculate total pages based on the number of page links excluding previous and next buttons
    if (currentPage < totalPages) {
      currentPage++;
      loadJobs(currentPage, perPage, null, selectedCategories);
    }
  });

  // Pagination click event for specific page
  $(".pagination-outer").on("click", "a.page-link", function (e) {
    e.preventDefault();
    var page = parseInt($(this).text());
    if (!isNaN(page)) {
      currentPage = page;
      loadJobs(currentPage, perPage, null, selectedCategories);
    }
  });

  // Event handler for changing number of jobs per page
  $(".product-filter-wrap select[data-bv-field='size']").change(function () {
    perPage = parseInt($(this).val());
    currentPage = 1; // Reset to first page
    loadJobs(currentPage, perPage, null, selectedCategories);
  });

  // Event handler for checkbox change
  $(".employment-checkbox").change(function () {
    selectedCategories = $(".employment-checkbox:checked")
      .map(function () {
        return $(this).val();
      })
      .get()
      .join(","); // Join the array elements with comma
    loadJobs(currentPage, perPage, "created_at", selectedCategories);
  });

  function loadJobs(page, perPage, sortBy, selectedCategories) {
    // If sortBy or selectedCategories are null, use default values
    sortBy = sortBy || "created_at";
    selectedCategories = selectedCategories || "all";

    $.ajax({
      url:
        "api/jobs/" +
        page +
        "/" +
        perPage +
        "/" +
        sortBy +
        "/" +
        selectedCategories,
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
    selectedCategories = selectedCategories || "all";

    $.ajax({
      url: "api/jobcount/" + selectedCategories,
      type: "GET",
      dataType: "json",
      success: function (response) {
        totaljobs = response.total_jobs;
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
    $(".woocommerce-result-count-left").text("Showing " + totalJobs + " jobs");
  }
});
