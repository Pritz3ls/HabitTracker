<?php include "php/db.php"?>
<?php include "php/update-pass.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <link rel="stylesheet" href="css/forgotpass.css">
    <title>habere | Change Password</title>
</head>
<body>
    <form action="" method="post" autocomplete="off">
        <div>
            <label for="username" method="post">Username</label>
            <input type="text" name="username" placeholder="Enter Username"required>
        </div>
        <div>
            <label for="new_password" method="post">New Password</label>
            <input type="password" name="new_password" placeholder="Enter New Password"required>
        </div>
        <div>
            <label for="confirm_password" method="post">Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Enter Confirm Password"required>
        </div>
        <div>
            <input type="submit" value="Continue" name="forgotPass">
        </div>
    </form>
</body>
</html>