let otpSent;
function requestOTP(resend = false){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        otpSent = this.response;
    }
    xhttp.open("POST", "php.otp/sendmail.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("otp=" + generateOTP()+"&resend="+resend);
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
    const userInputOTP = document.getElementById('otpinput').value;
    if(userInputOTP == otpSent){
        verifiedOTP();
    }else{
        alert("Incorrect OTP!");
    }
}