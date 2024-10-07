// Generate captcha function
function generateCaptcha() {
    let captchaText = "";
    const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (let i = 0; i < 6; i++) {
        captchaText += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    document.getElementById("captcha").innerText = captchaText;
    document.getElementById("hiddenCaptcha").value = captchaText; 
}
// Call the function
generateCaptcha();