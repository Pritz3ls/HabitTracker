<?php include "php/db.php"?>
<?php include "php/user-creation.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <title>habere | Account Settings</title>
</head>
<body>
<div class="navbar" id="navbar">
        <div class="navbar_logo"></div>
            <div class="navbar_items">
                <div>
                    <button type="button" onclick="burgir()">Close Menu</button>
                </div>
                <!-- Test Items -->
                <a href="testHabit.php">Main</a><br>
                <a href="">Dashboard</a><br>
                <a href="testLeaderBoard.php">Leaderboard</a><br>
                <a href="">Account Settings</a><br>
                <div>
                    <input type="button" value="logout" onclick="logout();">
                </div>
            </div>
        </div>
    <form  method="post" action="" autocomplete="off">
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
            <input type="password" id="password" name="password" placeholder="Enter Password" required >
            
        </div>
        
        
        <div>
            <input type="submit" value="SignUp" name="create">
        </div>
    </form>
    
</body>
</html>