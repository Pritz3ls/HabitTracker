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

    $fetch_email = "SELECT email, user_name FROM users WHERE id = $id";
    $user_found = mysqli_query($conn, $fetch_email);
    $row = mysqli_fetch_assoc($user_found);

    $email = $row['email'];
    $user_name = $row['user_name'];

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
    $message = 
    "<html>
    <body style=font-family: 'Poppins';padding: 5px;background-color: #ededed; display: flex; align-items: center; justify-content: center;'>
        <div class='mail' style='width: 480px; background-color: #FFFFFF;'>
            <header style='
                background-color: #122023;
                padding: 5px;
                color: #2ECC40;

                display: flex;
                align-items: center;
                gap: 10px;
                '>
                <h3 style='margin: 0; padding-left: 10px;'>Habere</h3>
            </header>
            <div class='body' style='padding: 5px; color: #122023'>
                <p>Hi $user_name,</p>
                <p style='color: #122023;'>Someone tried to access in to your habere account.</p>
                <p style='color: #122023;'>If this was you, please use the following code to confirm your identity:</p>
                <h2>$otp</h2>
            </div>
            <footer style='
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                color: #122023;
                '>
                <p style='margin: 0px 10px; font-size: 10px;'>Copyright © Habere. ILYSBU, Inc., Lipa, Batangas</p>
                <p style='margin: 0px 10px; font-size: 10px;'>This message was sent to $email and intended for $user_name.</p>
            </footer>
        </div>
    </body>
    </html>";
    
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