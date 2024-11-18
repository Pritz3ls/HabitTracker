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
    <script src="https://www.gstatic.com/charts/loader.js"></script> 
    
    <!-- i will disconnect the style for the admin, as i have plans for the look -->
    <!-- <link rel="stylesheet" href="css/dashboard-admin.css">  -->

    <!-- Load  -->
    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <link rel="stylesheet" href="css/palette.css">
    <link rel="stylesheet" href="css/dashboard-admin.css?v=<?php echo time(); ?>"> 
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>"> 
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
            <div class="dropdown">
                <button>
                    <i class="material-icons" style="vertical-align: middle;">manage_accounts</i>
                    Manage
                </button>
                <div class="dropdown-options">
                    <a href="manage-users.php">
                        <i class="material-icons" style="vertical-align: middle;">group</i>
                        Manage Users
                    </a>
                    <a href="manage-activity.php">
                        <i class="material-icons" style="vertical-align: middle;">event</i>
                        Manage Activity
                    </a>
                </div>
            </div>
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
                    <div id="lineChart" class="graph">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        google.charts.load('current',{packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        // drawChart.apply(null, args);
        // Your Function
        function drawChart(){
            // Set Data
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Date');
            data.addColumn('number', 'Registered Users');
            // data.addColumn('number', 'Active Users');
            data.addColumn('number', 'Habits');
            data.addColumn('number', 'Complete Habits');
            
            <?php
                $year = date('Y');
                $month = date('n')-1;
                $day = date('d');
            ?>
            // Add Data to the graph
            data.addRows([
                <?php
                    for ($i=0; $i < 6; $i++) { 
                        $regUsers = Fetch_GraphCustomData('users',$i);
                        // $activeUsers = Fetch_GraphCustomData('users',$i,true);
                        $habits = Fetch_GraphCustomData('habits',$i);
                        $comHabits = Fetch_GraphCustomData('habit_logs',$i);

                        echo "[new Date($year,$month-$i,1),{$regUsers},{$habits},{$comHabits}],";
                    }
                ?>
            ]);
                

            var options = {
                curveType: 'function',
                pointSize: 2,
                backgroundColor: { fill:'transparent' },
                fontName: 'Poppins',
                style: {
                    borderRadius: "25px",
                },
                // Legend
                legend: {
                    position: 'top',
                    alignment: 'center',
                    textStyle:{
                        bold: true,
                    }
                },
                // Axis
                vAxis: { 
                    format: '',
                    gridlines: {
                        color: 'none'
                    },
                    viewWindow:{
                        min:0
                    },
                    textStyle:{
                        bold: true,
                    }
                },
                hAxis: {
                    format: 'MMMM',
                    gridlines: {color: 'none'},
                    baselineColor: 'none',
                    textStyle:{
                        bold: true,
                    }
                },
                height: 250,
            };
            // Draw Chart
            const chart = new google.visualization.LineChart(document.getElementById('lineChart'));
            chart.draw(data, options);
        }
    </script> 
</body>
</html>