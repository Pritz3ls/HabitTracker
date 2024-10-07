<?php include "php/db.php"?>
<?php include "php/user-login.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Login</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="username" method="post">Username</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="password" method="post">Password</label>
            <input type="text" name="password" required>
        </div>
        <div>
            <a href="testForgotPassword.php">Forgot password</a>
        </div>
        <div>
            <input type="submit" value="Login" name="login">
        </div>
    </form>
</body>
</html>