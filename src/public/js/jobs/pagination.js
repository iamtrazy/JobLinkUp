$(document).ready(function () {
  var currentPage = 1;
  var perPage = 8; // Default number of jobs per page
  var sortBy = "created_at";
  var selectedCategories = "all"; // Initialize selected categories
  var timeCriterion = "all"; // Initialize time criterion
  var isLocation = 0;

  loadJobs(
    currentPage,
    perPage,
    "created_at",
    selectedCategories,
    timeCriterion
  );

  $(".product-filter-wrap select[data-bv-field='category']").change(
    function () {
      var selectedOption = $(this).val();
      // Default sorting by created_at
      if (selectedOption === "Category") {
        sortBy = "category";
      } else if (selectedOption === "Price") {
        sortBy = "price";
      } else if (selectedOption === "Most Recent") { 
        sortBy = "created_at";
      }

      currentPage = 1; // Assuming we always start from page 1 when sorting changes
      loadJobs(currentPage, perPage, sortBy, selectedCategories, timeCriterion);
    }
  );

  // Pagination click event for previous page
  $(".pagination-outer").on("click", ".prev", function (e) {
    e.preventDefault();
    if (currentPage > 1) {
      currentPage--;
      loadJobs(currentPage, perPage, null, selectedCategories, timeCriterion);
    }
  });

  // Pagination click event for next page
  $(".pagination-outer").on("click", ".next", function (e) {
    e.preventDefault();
    var totalPages = Math.ceil($(".pagination-list li").length - 2); // Calculate total pages based on the number of page links excluding previous and next buttons
    if (currentPage < totalPages) {
      currentPage++;
      loadJobs(currentPage, perPage, null, selectedCategories, timeCriterion);
    }
  });

  // Pagination click event for specific page
  $(".pagination-outer").on("click", "a.page-link", function (e) {
    e.preventDefault();
    var page = parseInt($(this).text());
    if (!isNaN(page)) {
      currentPage = page;
      loadJobs(currentPage, perPage, null, selectedCategories, timeCriterion);
    }
  });

  // Event handler for changing number of jobs per page
  $(".product-filter-wrap select[data-bv-field='size']").change(function () {
    perPage = parseInt($(this).val());
    currentPage = 1; // Reset to first page
    loadJobs(currentPage, perPage, null, selectedCategories, timeCriterion);
  });

  // Event handler for checkbox change
  $(".employment-checkbox").change(function () {
    selectedCategories = $(".employment-checkbox:checked")
      .map(function () {
        return $(this).val();
      })
      .get()
      .join(","); // Join the array elements with comma
    loadJobs(
      currentPage,
      perPage,
      "created_at",
      selectedCategories,
      timeCriterion
    );
  });

  // Event handler for time criterion change
  $(".twm-sidebar-ele-filter input[type='radio']").change(function () {
    timeCriterion = $(this).val();
    loadJobs(currentPage, perPage, null, selectedCategories, timeCriterion);
  });

  function loadJobs(
    page,
    perPage,
    sortBy,
    selectedCategories,
    timeCriterion,
    keyword
  ) {
    // If sortBy, selectedCategories, or timeCriterion are null, use default values
    sortBy = sortBy || "created_at";
    selectedCategories = selectedCategories || "all";
    timeCriterion = timeCriterion || "all";

    var apiUrl =
      "api/jobs/" +
      page +
      "/" +
      perPage +
      "/" +
      sortBy +
      "/" +
      timeCriterion +
      "/" +
      selectedCategories;

    // Add keyword parameter if provided
    if (keyword) {
      if (isLocation == 0) {
        apiUrl += "/" + encodeURIComponent(keyword) + "/0";
      } else if (isLocation == 1) {
        apiUrl += "/" + encodeURIComponent(keyword) + "/1";
      }
    }

    var apiJurl =
      "api/jobsearch/" +
      page +
      "/" +
      perPage +
      "/" +
      sortBy +
      "/" +
      timeCriterion +
      "/" +
      selectedCategories;

    // Add keyword parameter if provided
    if (keyword) {
      if (isLocation == 0) {
        apiJurl += "/" + encodeURIComponent(keyword) + "/0";
      } else if (isLocation == 1) {
        apiJurl += "/" + encodeURIComponent(keyword) + "/1";
      }
    }

    $.ajax({
      url: apiUrl,
      type: "GET",
      success: function (response) {
        $("#jobs").html(response);

        // Update pagination links
        fetchTotalJobsCount(apiJurl);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  function fetchJobTitles(
    currentPage,
    perPage,
    sortBy,
    selectedCategories,
    timeCriterion,
    keyword
  ) {
    $.ajax({
      url:
        "api/jobsearch/" +
        currentPage +
        "/" +
        perPage +
        "/" +
        sortBy +
        "/" +
        timeCriterion +
        "/" +
        selectedCategories +
        "/" +
        encodeURIComponent(keyword) +
        "/0",
      type: "GET",
      success: function (response) {
        // Extract job topics from the response
        var jobTopics = response.jobs.map(function (job) {
          return job.topic;
        });

        // Generate HTML for dropdown with job topics
        var dropdownHTML = jobTopics
          .map(function (topic) {
            return '<div class="dropdown-item">' + topic + "</div>";
          })
          .join("");

        // Populate dropdown with job topics
        $("#searchResults").html(dropdownHTML).show();
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  function fetchJobLocation(
    currentPage,
    perPage,
    sortBy,
    selectedCategories,
    timeCriterion,
    keyword
  ) {
    $.ajax({
      url:
        "api/jobsearch/" +
        currentPage +
        "/" +
        perPage +
        "/" +
        sortBy +
        "/" +
        timeCriterion +
        "/" +
        selectedCategories +
        "/" +
        encodeURIComponent(keyword) +
        "/1",
      type: "GET",
      success: function (response) {
        // Extract job topics from the response
        var jobTopics = response.jobs.map(function (job) {
          return job.location;
        });

        // Generate HTML for dropdown with job topics
        var dropdownHTML = jobTopics
          .map(function (topic) {
            return '<div class="dropdown-item">' + topic + "</div>";
          })
          .join("");

        // Populate dropdown with job topics
        $("#searchLocationResults").html(dropdownHTML).show();
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  var typingTimer; // Timer identifier
  var doneTypingInterval = 500; // Time in milliseconds (0.5 seconds)

  $("#searchInput").on("input", function () {
    clearTimeout(typingTimer); // Clear the timer on each input

    var keyword = $(this).val().trim();
    if (keyword !== "") {
      // Set a timer to delay the search by the defined interval
      typingTimer = setTimeout(function () {
        fetchJobTitles(
          currentPage,
          perPage,
          sortBy,
          selectedCategories,
          timeCriterion,
          keyword
        );
      }, doneTypingInterval);
    } else {
      $("#searchResults").empty().hide();
    }
  });

  $("#searchLocationInput").on("input", function () {
    clearTimeout(typingTimer); // Clear the timer on each input

    var keyword = $(this).val().trim();
    if (keyword !== "") {
      // Set a timer to delay the search by the defined interval
      typingTimer = setTimeout(function () {
        fetchJobLocation(
          currentPage,
          perPage,
          sortBy,
          selectedCategories,
          timeCriterion,
          keyword
        );
      }, doneTypingInterval);
    } else {
      $("#searchLocationResults").empty().hide();
    }
  });

  $("#searchButton").click(function () {
    var keyword = $("#searchInput").val().trim();
    if (keyword !== "") {
      isLocation = 0;
      loadJobs(
        currentPage,
        perPage,
        null,
        selectedCategories,
        timeCriterion,
        keyword
      );
    }
  });

  $("#searchLocationButton").click(function () {
    var keyword = $("#searchLocationInput").val().trim();
    if (keyword !== "") {
      isLocation = 1;
      loadJobs(
        currentPage,
        perPage,
        null,
        selectedCategories,
        timeCriterion,
        keyword
      );
    }
  });

  // Event handler for keypress event on search input
  $("#searchInput").keypress(function (event) {
    // Check if Enter key is pressed
    if (event.keyCode === 13) {
      var keyword = $(this).val().trim();
      if (keyword !== "") {
        loadJobs(
          currentPage,
          perPage,
          null,
          selectedCategories,
          timeCriterion,
          keyword
        );
      }
    }
  });

  $("#searchLocationInput").keypress(function (event) {
    // Check if Enter key is pressed
    if (event.keyCode === 13) {
      var keyword = $(this).val().trim();
      if (keyword !== "") {
        isLocation = 1;
        loadJobs(
          currentPage,
          perPage,
          null,
          selectedCategories,
          timeCriterion,
          keyword
        );
      }
    }
  });
  // Function to fetch total job count
  function fetchTotalJobsCount(apiUrl) {
    selectedCategories = selectedCategories || "all";

    $.ajax({
      url: apiUrl,
      type: "GET",
      dataType: "json",
      success: function (response) {
        totaljobs = response.job_count;
        updatePagination(response.job_count);
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
