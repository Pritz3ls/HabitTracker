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
            <img src="resource/application-icon.png" alt="">
        </div>
        <div class="navbar_items">
            <a href="admin-dashboard.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h240v-560H200v560Zm320 0h240v-280H520v280Zm0-360h240v-200H520v200Z"/></svg>
                <p>Dashboard</p>
            </a>
            <p>Manage</p>
            <a href="#">Manage Users</a>
            <a href="#">Manage Activity</a>
            <a href="admin-account-settings.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/></svg>
                <p>Settings</p>
            </a>
            <a href="php/user-logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
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