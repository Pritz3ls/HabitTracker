<?php include "php/db.php"?>
<?php include "php/update-pass.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/passwordstrength.js"></script>

    <link rel="stylesheet" href="css/palette.css">
    <link rel="stylesheet" href="css/forgotpass.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/pass-strength.css">
    <title>habere | Change Password</title>
</head>
<body>
    <form action="" method="post" autocomplete="off">
        <div>
            <label for="username" method="post">Username</label>
            <input type="text" name="username" placeholder="Enter Username" required>
        </div>
        <div>
            <label for="new_password" method="post">New Password</label>
            <input type="password" name="new_password" id="password" placeholder="Enter New Password" required onchange="checkPasswordStrength()">
            <input type="hidden" name="strIndex" id="strIndex" value=0>
            <p id="strength">Very Weak</p>
        </div>
        <div>
            <label for="confirm_password" method="post">Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Enter Confirm Password" required>
        </div>
        <div class="button-container">
            <input type="submit" value="Continue" name="forgotPass">
            <a href="testLogin.php" class="back-button">Back</a>
        </div>
    </form>
</body>
</html>
