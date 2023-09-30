const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

function switchModeBasedOnURL() {
  // Get the current URL
  const currentURL = window.location.href;

  // Check if the URL contains "/register" or "/login"
  if (currentURL.includes("/register")) {
    container.classList.add("sign-up-mode");
  } else if (currentURL.includes("/login")) {
    container.classList.remove("sign-up-mode");
  }
}

// Call the function to switch the mode based on the URL
switchModeBasedOnURL();


sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});
