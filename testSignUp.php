<?php include "php/db.php"?>
<?php include "php/user-creation.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/captcha.js"></script>
    <script defer src="js/passwordstrength.js"></script>

    <!-- Load  -->
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
            <input type="text" name="phonenumber" pattern="[+63][0-9]{10}" placeholder="+63 Phone Number" required>
        </div>
        <div>
            <label for="password" method="post">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required onchange="checkPasswordStrength()">
            <input type="hidden" name="strIndex" id="strIndex" value=0>
            <p id="strength"></p>
        </div>
        <div class="captcha">
            <label for="captchaInput">Enter Captcha</label>
            <span id="captcha"></span>
            <div class="captchaInput">
                <input type="text" id="captchaInput" name="captchaInput" placeholder="Enter Captcha" required>
                <button type="button" class="refreshCaptcha" onclick="generateCaptcha()">Refresh</button>
            </div>
            <input type="hidden" id="hiddenCaptcha" name="hiddenCaptcha">
        </div>
        <div class="button-container">
            <input type="submit" value="SignUp" name="create">
        </div>
        <div>
            <a href="testLogin.php">Already have an account? Login</a>
        </div>
        <!-- For Debugging purpose -->
        <!-- <div>
            <select name="user_type" id="" method="post">
                <option value="client">Client</option>
                <option value="admin">Admin</option>
            </select>
        </div> -->
        <div class="links">
            <a href="testLanding.php" class="auth-link">Back</a>
        </div>
    </form>
</body>
</html>