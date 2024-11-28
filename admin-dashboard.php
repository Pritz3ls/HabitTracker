<?php
    require "php/db.php";
    include 'php.utils/php-utils.php';
    include "php.utils/activity-logging.php";
    include 'php.dashboard/dashboard-admin-utils.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/navbar.js"></script>
    <!-- i will disconnect the style for the admin, as i have plans for the look -->
    <!-- <link rel="stylesheet" href="css/dashboard-admin.css">  -->
    
    <!-- Load  -->
    <script src=" https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js "></script>
    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <link rel="stylesheet" href="css/palette.css">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>"> 
    <link rel="stylesheet" href="css/dashboard-admin.css?v=<?php echo time(); ?>"> 
    <link rel="stylesheet" href="css/popup.css?v=<?php echo time(); ?>"> 
    <title>habere | Admin Dashboard</title>
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
            <a href="php/user-logout.php">
                <i class="material-icons">logout</i>
                <p>Logout</p>
            </a>
        </div>
    </div>

    <!-- Contents -->
    <div class="holder">
        <!-- MOTD -->
        <div class="dashboard-head">
            <div class="profile">
                <div class="info">
                    <h4>Welcome back,<br>
                        <?php echo Fetch_Username()?>
                    </h4>
                </div>
            </div>
        </div>
        <!-- Statistics Wrapper -->
        <div class="wrapper">
            <div class="statistics">
                <div class="container">
                    <div class="reports">
                        <!-- Registered Users Container -->
                        <div class="item">
                            <div class="content">
                                <div class="head">
                                    <p>Registered Users</p>
                                </div>
                                <div class="percentage">
                                    <h1>
                                        <?php echo Fetch_Total_RegisteredUsers()?>
                                    </h1>
                                </div>
                                <div class="label">
                                    <?php echo Fetch_Readings_RegisteredUsers()?>
                                </div>
                            </div>
                        </div>

                        <!-- Active Users -->
                        <div class="item">
                            <div class="content">
                                <div class="head">
                                    <p>Active Users</p>
                                </div>
                                <div class="percentage">
                                    <h1>
                                        <?php echo Fetch_Total_ActiveUsers()?>
                                    </h1>
                                </div>
                                <div class="label">
                                    <?php
                                        echo Fetch_Readings_ActiveUsers();
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Total Habits -->
                        <div class="item">
                            <div class="content">
                                <div class="head">
                                    <p>Habits</p>
                                </div>
                                <div class="percentage">
                                    <h1>
                                    <?php echo Fetch_Total_Habits()?>
                                    </h1>
                                </div>
                                <div class="label">
                                    <?php
                                        echo Fetch_Readings_Habits();
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Completed Habits -->
                        <div class="item">
                            <div class="content">
                                <div class="head">
                                    <p>Completed Habits</p>
                                </div>
                                <div class="percentage">
                                    <h1>
                                        <?php echo Fetch_Completed_Habits()?>
                                    </h1>
                                </div>
                                <div class="label">
                                    <?php
                                        echo Fetch_Readings_CompletedHabits();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <canvas id="myChart" class="chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="js/admin-graph-chart.js"></script>
</body>
</html>