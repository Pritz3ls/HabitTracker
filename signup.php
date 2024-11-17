<?php
    require "php/db.php";
    include "php/user-authentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/captcha.js"></script>
    <script defer src="js/showpassword.js"></script>
    <script defer src="js/passwordstrength.js"></script>

    <!-- Load  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">

    <link rel="stylesheet" href="css/palette.css">
    <link rel="stylesheet" href="css/signup.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/pass-strength.css?v=<?php echo time(); ?>">
    <title>habere | Signup</title>
</head>
<body>
    <!-- Spinner -->
    <div id="loading" class="loading">
        <div class="spinner"></div>
    </div>
    
    <form  method="post" action="" autocomplete="off">
        <h3>SIGNUP</h3>
        <div>
            <label for="username" method="post">Username</label>
            <input type="text" name="username" placeholder="Enter Username" required>
        </div>
        <div>
            <label for="phonenumber" method="post">Phone Number</label>
            <input type="text" name="phonenumber" pattern="[09][0-9]{10}" placeholder="+63 Phone Number" required>
        </div>
        <div>
            <label for="password" method="post">Password</label>
            <div class="password-input">
                <input type="password"  id="password" name="password"  class="form-control" placeholder="Enter Password" required onchange="checkPasswordStrength()">
                <input type="hidden" name="strIndex" id="strIndex" value=0>
                <button type="button">
                    <i class="material-icons" onclick="showPassword('password')">visibility</i>
                </button>
            </div>
            <p id="strength"></p>
        </div>
        <div class="captcha">
            <label for="captchaInput">Enter Captcha</label>
            <span id="captcha"></span>
            <div class="captchaInput">
                <input type="text" id="captchaInput" name="captchaInput" placeholder="Enter Captcha" required>
                <button type="button" class="refreshCaptcha" onclick="generateCaptcha()">
                    <i class="material-icons" id="toggle-password">refresh</i>
                </button>
            </div>
            <input type="hidden" id="hiddenCaptcha" name="hiddenCaptcha">
        </div>
        <div class="terms">
            <input type="checkbox" name="terms" required id="termsCheck">
            <label for="terms"> I agree to these <a href="#">Terms and Conditions</a>.</label>
        </div>
        <div class="button-container">
            <input type="submit" value="SignUp" name="create">
        </div>
        <div>
            <a href="login.php">Already have an account? Login</a>
        </div>
        <div class="links">
            <a href="index.php" class="auth-link">Back</a>
        </div>
    </form>
    <script>
        document.getElementById("termsCheck").required = true;
    </script>
</body>
</html>