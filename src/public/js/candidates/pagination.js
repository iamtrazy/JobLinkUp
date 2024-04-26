$(document).ready(function () {
  var currentPage = 1;
  var perPage = 10; // Default number of candidates per page
  var sortBy = "date_joined";
  var isLocation = 0;

  loadCandidates(currentPage, perPage, sortBy);

  // Event handler for changing sorting criteria
  $(".product-filter-wrap select[data-bv-field='category']").change(
    function () {
      var selectedOption = $(this).val();
      // Default sorting by created_at
      if (selectedOption === "Date Joined") {
        sortBy = "date_joined";
      } else if (selectedOption === "Profile Completion") {
        sortBy = "profile_completion";
      }
      currentPage = 1; // Reset to first page
      loadCandidates(currentPage, perPage, sortBy);
    }
  );

  // Pagination click event for previous page
  $(".pagination-outer").on("click", ".prev", function (e) {
    e.preventDefault();
    if (currentPage > 1) {
      currentPage--;
      loadCandidates(currentPage, perPage, sortBy);
    }
  });

  // Pagination click event for next page
  $(".pagination-outer").on("click", ".next", function (e) {
    e.preventDefault();
    var totalPages = Math.ceil($(".pagination-list li").length - 2); // Calculate total pages based on the number of page links excluding previous and next buttons
    if (currentPage < totalPages) {
      currentPage++;
      loadCandidates(currentPage, perPage, sortBy);
    }
  });

  // Pagination click event for specific page
  $(".pagination-outer").on("click", "a.page-link", function (e) {
    e.preventDefault();
    var page = parseInt($(this).text());
    if (!isNaN(page)) {
      currentPage = page;
      loadCandidates(currentPage, perPage, sortBy);
    }
  });

  // Event handler for changing number of candidates per page
  $(".product-filter-wrap select[data-bv-field='size']").change(function () {
    perPage = parseInt($(this).val());
    currentPage = 1; // Reset to first page
    loadCandidates(currentPage, perPage, sortBy);
  });

  function fetchCandidates(currentPage, perPage, sortBy, keyword) {
    $.ajax({
      url:
        "api/candidates_search/" +
        currentPage +
        "/" +
        perPage +
        "/" +
        sortBy +
        "/" +
        encodeURIComponent(keyword) +
        "/0",
      type: "GET",
      success: function (response) {
        // Extract candidate topics from the response
        var candidateNames = response.candidates.map(function (candidate) {
          return candidate.username;
        });

        // Generate HTML for dropdown with candidate topics
        var dropdownHTML = candidateNames
          .map(function (username) {
            return '<div class="dropdown-item">' + username + "</div>";
          })
          .join("");

        // Populate dropdown with candidate topics
        $("#searchResults").html(dropdownHTML).show();
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
        fetchCandidates(currentPage, perPage, sortBy, keyword);
      }, doneTypingInterval);
    } else {
      $("#searchResults").empty().hide();
    }
  });

  // Event handler for search button click
  $("#searchButton").click(function () {
    var keyword = $("#searchInput").val().trim();
    if (keyword !== "") {
      isLocation = 0;
      loadCandidates(currentPage, perPage, sortBy, keyword);
    }
  });

  // Event handler for location search button click
  $("#searchLocationButton").click(function () {
    var keyword = $("#searchLocationInput").val().trim();
    if (keyword !== "") {
      isLocation = 1;
      loadCandidates(currentPage, perPage, sortBy, keyword);
    }
  });

  // Function to load candidates
  function loadCandidates(page, perPage, sortBy, keyword = "") {
    var apiUrl = "api/candidates/" + page + "/" + perPage + "/" + sortBy;

    // Add keyword parameter if provided
    // Add keyword parameter if provided
    if (keyword) {
      apiUrl += "/" + encodeURIComponent(keyword) + "/" + isLocation;
    }

    var apiJurl =
      "api/candidates_search/" + page + "/" + perPage + "/" + sortBy;

    if (keyword) {
      apiJurl += "/" + encodeURIComponent(keyword) + "/" + isLocation;
    }

    $.ajax({
      url: apiUrl,
      type: "GET",
      success: function (response) {
        $(".twm-candidates-grid-wrap .row").html(response);

        // Update pagination links
        fetchTotalCandidatesCount(apiJurl);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  $("#searchButton").click(function () {
    var keyword = $("#searchInput").val().trim();
    if (keyword !== "") {
      isLocation = 0;
      loadCandidates(currentPage, perPage, null, keyword);
    }
  });

  $("#searchLocationButton").click(function () {
    var keyword = $("#searchLocationInput").val().trim();
    if (keyword !== "") {
      isLocation = 1;
      loadCandidates(currentPage, perPage, null, keyword);
    }
  });

  // Event handler for keypress event on search input
  $("#searchInput").keypress(function (event) {
    // Check if Enter key is pressed
    if (event.keyCode === 13) {
      var keyword = $(this).val().trim();
      if (keyword !== "") {
        loadCandidates(currentPage, perPage, null, keyword);
      }
    }
  });

  $("#searchLocationInput").keypress(function (event) {
    // Check if Enter key is pressed
    if (event.keyCode === 13) {
      var keyword = $(this).val().trim();
      if (keyword !== "") {
        isLocation = 1;
        loadCandidates(currentPage, perPage, null, keyword);
      }
    }
  });

  function fetchTotalCandidatesCount(apiUrl) {
    $.ajax({
      url: apiUrl,
      type: "GET",
      dataType: "json",
      success: function (response) {
        updatePagination(response.candidate_count);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  // Function to update pagination links
  function updatePagination(totalCandidates) {
    var totalPages = Math.ceil(totalCandidates / perPage);

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

    // Update number of candidates shown
    $(".woocommerce-result-count-left").text(
      "Showing " + totalCandidates + " candidates"
    );
  }
});
