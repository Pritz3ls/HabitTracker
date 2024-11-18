<?php
    require 'php/db.php';
    include 'php/account-settings.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/navbar.js"></script>
    
    <script src="js/update-info-ajax.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">
    
    <!-- Disconnect notification js for now -->
    <!-- <script defer src="js/notification.js"></script> -->
    
    <link rel="stylesheet" href="css/account-settings.css">
    <link rel="stylesheet" href="css/palette.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/dashboard-user.css">

    <title>habere | Account Settings</title>
</head>
<body>
    <!-- Spinner -->
    <div id="loading" class="loading">
        <div class="spinner"></div>
    </div>
    <!-- Navigation Bar -->
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

    <div class="container">
        <!-- Profile Information -->
        <div class="wrapper info">
            <h4>Profile Information</h4>
            <form action="" method="post">
                <label for="username">Username</label>
                <div>
                    <input type="text" name="username" id="username" value="<?php echo Fetch_Username()?>">
                </div>
                <label for="pass">Password</label>
                <div class="input-password">
                    <input type="password" name="pass" id="pass" value="<?php echo Fetch_Password()?>">
                    <button type="button">
                        <i class="material-icons">visibility</i>
                    </button>
                </div>
                <div>
                    <button type="button" class="submit" onclick='ConfirmChanges()'>Update</button>
                </div>
            </form>
        </div>
        <!-- Notifacition Settings -->
        <div class="wrapper notif">
            <h4>Notification Settings</h4>
            <div class="items">
                <!-- Head -->
                <div class="item">
                    <p>Customize Notifications</p>
                </div>

                <!-- Performance Reports -->
                <div class="item">
                    <h4>Reports</h4>
                    <p>Receive Reports on how you perform this month, include or exclude what reports you want to receive.</p>
                    <?php echo Fetch_Preferences()?>                    
                </div>

                </div>
                <!-- 2FA -->
                <div class="item">
                    <h4>Two Factor Authentication</h4>
                    <p>Enable Two Factor Authentication, receive a 6 digit code from your mobile phone number.</p>
                    <p class="warning">(Warning: This would put your account at risk)</p>
                    <div>
                        <label for="enable2FA">Enable 2FA</label>
                        <input type="checkbox" name="enable2FA" id="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>