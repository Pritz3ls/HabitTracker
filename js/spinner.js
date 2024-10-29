// Loader
// Animate a spinner when loading the page
const loading = document.getElementById('loading');
setTimeout(function() {
    loading.classList.add("hide-loader"); // Hide the loading animation
}, 100); // Add a .5 second delay to simulate a slower page for the loading animation