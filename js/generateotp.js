let generatedOTP = '';

function requestOTP() {
    const userIdentifier = document.getElementById('userIdentifier').value;

    // Check if input is not empty
    if (userIdentifier) {
        generatedOTP = generateOTP();
        // Here you would normally send the OTP to the user via email or SMS.
        console.log(`OTP sent to ${userIdentifier}: ${generatedOTP}`);

        // Show the OTP input form
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('otpForm').style.display = 'block';
        document.getElementById('otpMessage').innerText = 'OTP has been sent to your email/phone number.';
    } else {
        alert('Please enter your email or phone number.');
    }
}

function generateOTP() {
    const length = 6;
    let otp = '';

    // dito nag ggenerate ng otp
    for (let i = 0; i < length; i++) {
        otp += Math.floor(Math.random() * 10); // Random digit 0 hanghang 9
    }
    
    return otp;
}

function verifyOTP() {
    const userOTP = document.getElementById('otpInput').value;

    if (userOTP === generatedOTP) {
        document.getElementById('otpMessage').innerText = 'OTP verified successfully! Welcome!';
    } else {
        document.getElementById('otpMessage').innerText = 'Invalid OTP. Please try again.';
    }
}




