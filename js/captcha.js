// Function to generate a random CAPTCHA string
function generateCaptcha() {
    const charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let captchaValue = '';
    
    // Generate a random 6-character CAPTCHA string
    for (let i = 0; i < 6; i++) {
        let randomIndex = Math.floor(Math.random() * charset.length);
        captchaValue += charset[randomIndex];
    }
    
    // Display the CAPTCHA and store it in the hidden field
    document.getElementById('captcha').textContent = captchaValue;
    document.getElementById('hiddenCaptcha').value = captchaValue;
}

// Validate CAPTCHA before form submission (client-side check)
document.querySelector('form').addEventListener('submit', function(e) {
    var enteredCaptcha = document.getElementById('captchaInput').value;
    var hiddenCaptcha = document.getElementById('hiddenCaptcha').value;

    // Check if entered CAPTCHA matches generated CAPTCHA
    if (enteredCaptcha !== hiddenCaptcha) {
        alert('Incorrect CAPTCHA!');
        e.preventDefault(); // Prevent form submission if CAPTCHA is wrong
    }
});

// Ensure CAPTCHA is generated on page load
window.onload = function() {
    generateCaptcha();
};
