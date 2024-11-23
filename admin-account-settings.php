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
    <script defer src="js/showpassword.js"></script>
    <link rel="stylesheet" href="css/spinner.css">
    
    <!-- Disconnect notification js for now -->
    <!-- <script defer src="js/notification.js"></script> -->
    
    <link rel="stylesheet" href="css/palette.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/account-settings.css">

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
            <img src="resource/application-icon.png" alt="Application Icon">
        </div>

        <div class="navbar_items">
            <a href="admin-dashboard.php">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
            </a>
            <button onclick='showSubMenu("mis",this)'>
                <i class="material-icons" style="vertical-align: middle;">keyboard_arrow_down</i>
                <p>Manage</p>
            </button>
            <div class="submenu" id="mis">
                <a href="manage-users.php">
                    <i class="material-icons" style="vertical-align: middle;">group</i>
                    <p>Manage Users</p>
                </a>
                <a href="manage-activity.php">
                    <i class="material-icons" style="vertical-align: middle;">event</i>
                    <p>Manage Activity</p>
                </a>
            </div>
            <a href="generate-report.php">
                <i class="material-icons">summarize</i>
                <p>Generate Report</p>
            </a>
            <a href="admin-account-settings.php">
                <i class="material-icons">settings</i>
                <p>Settings</p>
            </a>
            <a href="php/user-logout.php">
                <i class="material-icons">logout</i>
                <p>Logout</p>
            </a>
        </div>
    </div>

    <header>
        <h1>Account Settings</h1>
    </header>
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
                    <button type="button" onClick="showPassword('pass')">
                        <i class="material-icons">visibility</i>
                    </button>
                </div>
                <div>
                    <button type="button" class="submit" onclick='ConfirmChanges()'>Update</button>
                </div>
            </form>
        </div>
        <!-- Notifacition Settings -->
        <!-- <div class="wrapper notif">
            <h4>Notification Settings</h4>
            <div class="items">
                <div class="item">
                    <p>Customize Notifications</p>
                </div>
                </div>
                <div class="item">
                    <h4>Two Factor Authentication</h4>
                    <p>Enable Two Factor Authentication, receive a 6 digit code from your mobile phone number.</p>
                    <p class="warning">(Warning: This would put your account at risk)</p>
                    <div>
                        <input type="checkbox" name="enable2FA" id="">
                        <label for="enable2FA">Enable 2FA</label>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</body>
</html>