<?php
    require "php/db.php";
    include "php.utils/activity-logging.php";
    include "php.utils/php-utils.php";
    include "php.dashboard/dashboard-user-utils.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/navbar.js"></script>

    <!-- Load  -->
    <script src=" https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js "></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="js/motivation.js"></script>

    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">

    <!-- Disconnect notification js for now -->
    <!-- <script defer src="js/notification.js"></script> -->
    
    <link rel="stylesheet" href="css/palette.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/dashboard-user.css">
    <title>habere | Dashboard</title>
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

    <!-- Contents -->
    <div class="container bod">
        <div class="holder fgrow">
            <!-- Statistics -->
            <div class="container statistics">
                <!-- Events -->
                <div class="wrapper fgrow profile">
                    <div class="info">
                        <h1>Welcome back, <?php echo Fetch_Username()?></h1>
                        <p>
                            <script>
                                document.write(GetMotivationQuotes());
                            </script>
                        </p>
                        <a href="habit-main.php">Get Started
                            <i class="material-icons">chevron_right</i>
                        </a>
                    </div>
                </div>
                <!-- Progress -->
                <div class="wrapper square progress">
                    <div class="note">
                        <p>Total Habits, <?php echo Fetch_Total_Habits();?></p>
                    </div>
                    
                    <div class="total">
                        <h1><?php echo Fetch_Completed_Habits()?></h1>
                        <p>Habits Done</p>
                    </div>
                </div>
            </div>
            <!-- Graph -->
            <div class="container fgrow">
                <div class="wrapper graph dircolumn">
                    <canvas id="myChart" class="chart"></canvas>
                </div>
            </div>
        </div>
        <div class="holder fill todo">
            <div class="wrapper">
                <p>Today Habits</p>
            </div>
            <div class="container dircolumn habitcon">
                <?php Fetch_TodayHabits()?>
            </div>
        </div>
    </div>
    <script src="js/user-graph-chart.js"></script>
</body>
</html>