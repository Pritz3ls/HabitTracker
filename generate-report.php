<?php
    require 'php/db.php';
    include 'php-generatereport.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>habere | Generate Report</title>
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    
    <script defer src="js/navbar.js"></script>

    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <link rel="stylesheet" href="css/navbar.css"> 
    <link rel="stylesheet" href="css/palette.css">
    <link rel="stylesheet" href="css/generatereport.css">
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

    <div class="container">
        <!-- target="_blank" -->
        <form action="" method="post" target="_blank">
            <h2>Generate Report</h2>
            <!-- Date Range -->
            <div class="date">
                <div>
                    <label for="start">Start Date</label>
                    <input type="date" name="start" required>
                </div>
                <div>
                    <label for="end">End Date</label>
                    <input type="date" name="end" required>
                </div>
            </div>
            <!-- Include -->
            <h4>Include or Exclude items</h4>
            <div class="include">
                <div>
                    <input type="checkbox" name="retention" checked>
                    <label for="retention">User Retention Rate</label>
                </div>
                <div>
                    <input type="checkbox" name="habitTrends" checked>
                    <label for="habitTrends">Habit Trends </label>
                </div>
            </div>
            <div>
                <input type="submit" name="genrep" value="Generate">
            </div>
        </form>
    </div>
</body>
</html>