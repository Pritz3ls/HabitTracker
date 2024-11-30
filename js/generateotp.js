let otpSent;

function authOTP(resend = false){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        otpSent = this.response;
    }
    xhttp.open("POST", "php.otp/sendmail.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("otp=" + generateOTP()+"&auth=true&resend="+resend);

    Swal.fire('OTP Sent!', '', 'success');
}
function verifyEmail(resend = false){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        otpSent = this.response;
    }
    xhttp.open("POST", "php.otp/sendmail.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("otp=" + generateOTP()+"&verify=true&resend="+resend);
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