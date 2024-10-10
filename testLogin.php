<?php include "php/db.php"?>
<?php include "php/user-login.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/captcha.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <title>habere | Login</title>
</head>
<body>

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
        <div>
            <a href="testForgotPassword.php">Forgot password</a>
        </div>
        <div>
            <a href="testSignUp.php">Don't have an account?</a>
        </div>
        <div>
            <input type="submit" value="Login" name="login">
        </div>
        </form>
</body>
</html>