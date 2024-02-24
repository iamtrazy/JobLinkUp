
document.addEventListener("DOMContentLoaded", function() {
    // Get references to the toggle button and sidebar
    const toggleButton = document.querySelector('.toggle');
    const navigation = document.querySelector('.navigation');

    // Add click event listener to the toggle button
    toggleButton.addEventListener('click', function() {
        // Toggle the active class on the navigation sidebar
        navigation.classList.toggle('active');
    });
});