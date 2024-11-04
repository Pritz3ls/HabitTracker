<?php include "php/db.php"?>
<?php include "php/user-login.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <!-- Load  -->
    <script defer src="js/spinner.js"></script>
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
        <div>
            <label for="username" method="post">Username</label>
            <input type="text" name="username" placeholder="Enter Username" required>
        </div>
        <div>
            <label for="password" method="post">Password</label>
            <input type="password" name="password" placeholder="Enter Password" required>
        </div>
        <div class="captcha">
            <label for="captchaInput">Enter Captcha</label><br>
            <span id="captcha"></span><br>
            <input type="text" id="captchaInput" name="captchaInput" placeholder="Enter Captcha" required><br>
            <button type="button" onclick="generateCaptcha()">Refresh</button>
            <input type="hidden" id="hiddenCaptcha" name="hiddenCaptcha">
        </div>
        <div class="auth-link-container">
            <a href="testForgotPassword.php" class="auth-link">Forgot password</a>
        </div>
        <div class="auth-link-container">
            <a href="testSignUp.php" class="auth-link">Don't have an account?</a>
        </div>
        <div>
            <input type="submit" value="Login" name="login">
        </div>
         <div class="button-container">
        <a href="testLanding.php" class="back-button">Back</a>
        </div>
        </form>
</body>
</html>