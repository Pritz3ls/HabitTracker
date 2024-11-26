<?php 
    include "php/db.php";
    include "php.utils/activity-logging.php";
    include "php/user-authentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    
    <!-- Load  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script defer src="js/spinner.js"></script>
    <script defer src="js/showpassword.js"></script>
    <link rel="stylesheet" href="css/spinner.css">
    
    <script defer src="js/captcha.js?v=<?php echo time(); ?>"></script>

    <link rel="stylesheet" href="css/palette.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
    <title>habere | Login</title>
</head>
<body>
    <!-- Spinner -->
    <div id="loading" class="loading">
        <div class="spinner"></div>
    </div>
    
    <form action="" method="post" autocomplete="off">
        <h3>LOGIN</h3>
        <div>
            <label for="username" method="post">Username</label>
            <input type="text" name="username" placeholder="Enter Username" required>
        </div>
        <div class="password-input">
            <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
            <button type="button">
                <i class="material-icons" onClick="showPassword('password')">visibility</i>
            </button>
        </div>
        <div class="captcha">
            <label for="captchaInput">Enter Captcha</label><br>
            <span id="captcha"></span><br>
            <div class="captchaInput">
                <input type="text" id="captchaInput" name="captchaInput" placeholder="Enter Captcha" required><br>
                <button type="button" class="refreshCaptcha" onclick="generateCaptcha()">
                    <i class="material-icons">refresh</i>
                </button>
            </div>
            <input type="hidden" id="hiddenCaptcha" name="hiddenCaptcha">
        </div>
        <div>
            <input type="submit" value="Login" name="login">
        </div>
        <div class="auth-link-container">
            <a href="password-recovery.php" class="auth-link">Forgot password</a>
        </div>
        <div class="auth-link-container">
            <a href="signup.php" class="auth-link">Don't have an account? SignUp</a>
        </div>
        <div class="button-container">
            <a class="auth-link" href="javascript:history.back()">Back</a>
        </div>
        </form>
</body>
</html>