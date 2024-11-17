<?php
    require "php/db.php";
    include "php.utils/activity-logging.php";
    include "php/update-pass.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/passwordstrength.js"></script>

    <!-- Load  -->
    <script defer src="js/spinner.js"></script>
    <script defer src="js/showpassword.js"></script>
    <link rel="stylesheet" href="css/spinner.css">

    <link rel="stylesheet" href="css/palette.css">
    <link rel="stylesheet" href="css/forgotpass.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/pass-strength.css?v=<?php echo time(); ?>">
    <title>habere | Change Password</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Spinner -->
    <div id="loading" class="loading">
        <div class="spinner"></div>
    </div>
    
    <form action="" method="post" autocomplete="off">
        <h3>FORGOT PASSWORD</h3>
        <div>
            <label for="phonenumber" method="post">Phone Number</label>
            <input type="text" name="phonenumber" pattern="[09][0-9]{10}" placeholder="+63 Phone Number" required>
        </div>
        <div>
            <label for="new_password" method="post">New Password</label>
            <input type="password" name="new_password" id="password-field" class="form-control" placeholder="Enter New Password" required onchange="checkPasswordStrength()">
            <input type="hidden" name="strIndex" id="strIndex" value=0>
            <p id="strength"></p>
            <i class="fa fa-eye toggle-password"></i>
        </div>
        <div>
            <label for="confirm_password" method="post">Confirm Password</label>
            <input type="password" name="confirm_password"  id="password-field" class="form-control" placeholder="Enter Confirm Password" required>
            <i class="fa fa-eye toggle-password"></i>
        </div>
        <input type="submit" value="Continue" name="forgotPass">
        <div class="button-container">
            <a href="login.php" class="back-button">Back</a>
        </div>
    </form>
</body>
</html>
