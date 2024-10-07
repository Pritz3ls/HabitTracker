<?php include "php/db.php"?>
<?php include "php/user-creation.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/SignUp.css">
    <title>Test SignUp</title>
    
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="username" method="post">Username</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="phonenumber" method="post">Phone Number</label>
            <input type="text" name="phonenumber" required>
        </div>
        <div>
            <label for="password" method="post">Password</label>
            <input type="text" name="password" required>
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