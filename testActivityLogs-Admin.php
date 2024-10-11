<?php include "php/db.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="js/navbar.js"></script>
    <script defer src="js/logout.js"></script>
    
    <!-- i will disconnect the style for the admin, as i have plans for the look -->
    <!-- <link rel="stylesheet" href="css/dashboard-admin.css">  -->
    
    <link rel="stylesheet" href="css/(DEBUG)admin-dashboard.css?v=<?php echo time(); ?>">
    <title>habere | Admin Activity Logs</title>
</head>
<body>
    <div>
        <button type="button" onclick="burgir()">Burgir Menu</button>
    </div>
    <h1>Admin Activity Logs</h1>
    <div class="navbar" id="navbar">
        <div class="navbar_logo"></div>
        <div class="navbar_items">
            <div>
                <button type="button" onclick="burgir()">Close Menu</button>
            </div>
            <a href="testDashboard-Admin.php">Dashboard</a><br>
            <a href="testActivityLogs-Admin.php">Activity Logs</a><br>
            <a href="">Account Settings</a><br>
            <div>
                <input type="button" value="logout" onclick="logout();">
            </div>
        </div>
    </div>
</body>
</html>