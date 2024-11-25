<?php
    // Include PHPMailer Library
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'vendor/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/src/SMTP.php';

    include '../php/db.php';
    
    // Get the email of the person trying to login
    // From previous context of login, or password recovery
    $id = $_SESSION['tempVerifyUser'];

    $fetch_email = "SELECT email FROM users WHERE id = $id";
    $user_found = mysqli_query($conn, $fetch_email);
    $row = mysqli_fetch_assoc($user_found);
    $email = $row['email'];

    $otp = $_POST['otp'];
    $resend = $_POST['resend'];

    // Check if the OTP is already sent to this email
    if(empty($_SESSION['tempOTP']) || $resend == 'true'){
        // Retrieve the sent OTP
        $_SESSION['tempOTP'] = $otp;
    }else{
        $otp = $_SESSION['tempOTP'];
        echo $otp;
        return;
    }
    echo $otp;
    $message = "Your Habere OTP Code is: $otp. Do not share this with anyone.";
    
    $otpmail = new PHPMailer(true);
    
    // Setup the PHPMailer address and app passkey
    $otpmail->isSMTP();
    $otpmail->Host = 'smtp.gmail.com';
    $otpmail->SMTPAuth = true;
    $otpmail->Username = 'web.habere@gmail.com';
    $otpmail->Password = 'qgvnwqbhfejqklih';
    $otpmail->SMTPSecure = 'ssl';
    $otpmail->Port = 465;

    // Add an address, for this matter, use the preceeding email
    $otpmail->setFrom('web.habere@gmail.com');
    $otpmail->addAddress($email);
    $otpmail->isHTML(true);
    
    // Add a subject
    $otpmail->Subject = 'Habere OTP Code ';
    // Add a message body, for this use OTP
    $otpmail->Body = $message;
    
    // Send the mail
    $otpmail->send();
?>