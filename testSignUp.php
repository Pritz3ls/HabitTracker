<?php include "php/db.php"?>
<?php include "php/user-creation.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="js/captcha.js"></script>
    <link rel="stylesheet" href="css/signup.css">
    <title>Test SignUp</title>
</head>
<body>
    <form action="" method="post" autocomplete="off">
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
            <input type="password" name="password" placeholder="Enter Password" required>
        </div>
        <div class="captcha">
            <label for="captchaInput">Enter Captcha</label>
            <span id="captcha"></span>
            <input type="text" id="captchaInput" name="captchaInput" placeholder="Enter Captcha" required>
            <button type="button" onclick="generateCaptcha()">Refresh</button>
            <input type="hidden" id="hiddenCaptcha" name="hiddenCaptcha">
        </div>
        <div>
            <a href="testLogin.php">Already have an account?</a>
        </div>
        <div>
            <select name="user_type" id="" method="post">
                <option value="client">Client</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div>
            <input type="submit" value="SignUp" name="create">
        </div>
    </form>
</body>
</html>