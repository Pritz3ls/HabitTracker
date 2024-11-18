<?php
    require "php/db.php";
    include "php.utils/activity-logging.php";
    include "php/update-account.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/navbar.js"></script>
    <script defer src="js/passwordstrength.js"></script>
   
    <!-- Load  -->
    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="css/palette.css">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>"> 
    <link rel="stylesheet" href="css/settings.css?v=<?php echo time(); ?>"> 
    <title>habere | Account Settings</title>
</head>
<body>
    <!-- Spinner -->
    <div id="loading" class="loading">
        <div class="spinner"></div>
    </div>
    
    <!-- Burger Button -->
    <div class="header">
        <!-- Burger Button -->
        <button type="button" onclick="burgir();" class="burgir">=</button>
    </div>

    <!-- Navigation Bar -->
    <div class="navbar" id="navbar">
        <div class="navbar_logo">
            <img src="resource/application-icon.png" alt="">
        </div>
        <div class="navbar_items">
            <a href="habit-main.php">
                <i class="material-icons">home</i>
                <p>My Habits</p>
            </a>
            <a href="user-dashboard.php">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
            </a>
            <a href="user-leaderboard.php">
                <i class="material-icons">leaderboard</i>
                <p>Leaderboard</p>
            </a>
            <a href="user-account-settings.php">
                <i class="material-icons">account_circle</i>
                <p>Settings</p>
            </a>
            <a href="php/user-logout.php">
                <i class="material-icons">logout</i>
                <p>Logout</p>
            </a>
        </div>
    </div>

    <!-- Update Account Information -->
    <form  method="post" action="" autocomplete="off">
        <h1>Account Settings</h1>
        <?php
            $user_info_query = "SELECT user_name, phone_number, password FROM users WHERE id = {$_SESSION['currentUserID']}";
            $user_info = mysqli_query($conn, $user_info_query);
            if(!$user_info){
                echo "Cannot find the specified user!";
            }
            $info = mysqli_fetch_assoc($user_info);
        ?>
        <div>
            <label for="username" method="post">Username</label>
            <?php echo '<input type="text" name="username" value='.$info['user_name'].' required>';?>
        </div>
        <div>
            <label for="phonenumber" method="post">Phone Number</label>
            <?php echo '<input type="text" name="phonenumber" pattern="[09][0-9]{10}" value='.$info['phone_number'].' required>';?>
        </div>
        <div>
            <label for="password" method="post">Password</label>
            <?php echo '<input type="text" id="password" name="password" value='.$info['password'].' required onchange="checkPasswordStrength();">';?>
            <input type="hidden" name="strIndex" id="strIndex" value=0>
            <p id="strength"></p>
        </div>
        <div>
            <input type="submit" value="Update" name="update_info">
        </div>
    </form>
    
    <!-- Notification Settings -->
    <h1>Notification Settings</h1>
    <p>Work in progress</p>
</body>
</html>