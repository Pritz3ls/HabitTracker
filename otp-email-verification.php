<?php
    require "php/db.php";
    include "php.utils/activity-logging.php";
    include "php/user-authentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/generateotp.js"></script>
    
    <!-- Load  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">

    <link rel="stylesheet" href="css/palette.css">
    <link rel="stylesheet" href="css/otpauth.css">
    <title>habere | Email Verification</title>
</head>
<body>
    <!-- Spinner -->
    <div id="loading" class="loading">
        <div class="spinner"></div>
    </div>
    
    <div class="container">
        <h2>sa</h2>
        <form action="" method="post" autocomplete="off">
            <div>
                <?php
                    $tempEmail = $_SESSION['temp_email'];
                ?>
                <h3>Email Verification</h3>
                <p>A One-Time Password has been sent to <?php echo $tempEmail?></p>
            </div>
            <div class="otp-container">
                <input type="text" name="otpinput" inputmode="numeric" maxlength="6" placeholder="______"required>
            </div>
            <div>
                <input type="submit" value="Validate" name="verify-email">
            </div>
            <div>
                <button type="button" class="resend" onclick="verifyEmail()">Resend One-Time Password</button>
                <a href="signup.php">Back</a>
            </div>
        </form>
    </div>
    <script>
        window.onload = verifyEmail();
    </script>
</body>
</html>