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

// Ensure CAPTCHA is generated on page load
generateCaptcha();