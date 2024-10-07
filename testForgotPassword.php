<?php include "php/db.php"?>
<?php include "php/update-pass.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Forgot Password</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="username" method="post">Username</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="new_password" method="post">New Password</label>
            <input type="text" name="new_password" required>
        </div>
        <div>
            <label for="confirm_password" method="post">Confirm Password</label>
            <input type="text" name="confirm_password" required>
        </div>
        <div>
            <input type="submit" value="Continue" name="forgotPass">
        </div>
    </form>
</body>
</html>