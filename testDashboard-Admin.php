<?php include "php/db.php"?>
<?php include "php/admin.php"?>
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

    <h1>Admin Dashboard</h1>
    
    <!-- Navigation Bar -->
    <div class="navbar" id="navbar">
        <div class="navbar_logo">
            <img src="resource/application-icon.png" alt="">
        </div>
        <div class="navbar_items">
            <a href="testDashboard-Admin.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h240v-560H200v560Zm320 0h240v-280H520v280Zm0-360h240v-200H520v200Z"/></svg>
                <p>Dashboard</p>
            </a>
            <a href="testAccountSettings-Admin.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/></svg>
                <p>Settings</p>
            </a>
            <a href="php/user-logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                <p>Logout</p>
            </a>
        </div>
    </div>

    <!-- Tables -->
    <div class="table-wrapper">
        <h2>Users</h2>
        
        <!-- Search for user table -->
        <form action="" method="post">
            <div>
                <label for="search_user">Search User</label>
                <input type="text" name="search_user" id="" placeholder="Username">
                <input type="submit" name="user_search" value="Search">
            </div>
        </form>

        <!-- User Table -->
        <div class="table-scroll">
            <table>
                <thead>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Phonenumber</th>
                    <th>Account Created</th>
                    <th>Operation</th>
                </thead>
                <tbody>
                    <?php
                        if(isset($_POST['user_search'])){
                            $query = "SELECT * FROM users WHERE user_name LIKE '%{$_POST['search_user']}%' AND user_type = 'client' AND deleted_at IS NULL";
                        }else{
                            $query = "SELECT * FROM `users` WHERE user_type = 'client' AND deleted_at IS NULL";
                        }

                        // Execute the query
                        $users = mysqli_query($conn, $query);
                        // Indication on how many rows
                        echo "Displayed ".mysqli_num_rows($users)." results.";
                        while($row = mysqli_fetch_assoc($users)){
                            echo "<tr>";
                                echo '<form action="" method="post">';
                                    $user_id = $row['id'];
                                    $username = $row['user_name'];
                                    $password = $row['password'];
                                    $phonenumber = $row['phone_number'];
                                    $account_created = $row['account_created_at'];

                                        echo "<td>".$user_id."</td>";
                                        echo "<td>".$username."</td>";
                                        echo "<td>".$password."</td>";
                                        echo "<td>".$phonenumber."</td>";
                                        echo "<td>".$account_created."</td>";
                                        echo '<td>';
                                            echo '<input type="submit" name="edit" value="Edit">';
                                            echo '<input type="submit" name="delete" value="Delete">';
                                            echo '<input type="hidden" name="selectedUserID" value='.$user_id.'>';
                                        echo '</td>';
                                echo "</form>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        
        <h2>Activity Logs</h2>
        
        <!-- Search for activity logs table -->
        <form action="" method="post">
            <div>
                <label for="search_log">Search Logs</label>
                <input type="date" name="search_log" id=""  >
                <input type="submit" name="log_search" value="Search">
            </div>
        </form>

        <!-- Activity Logs -->
        <div class="table-scroll">
            <table>
                <thead>
                    <th>ID</th>
                    <th>Admin ID</th>
                    <th>Operation</th>
                    <th>Date</th>
                </thead>
                <tbody>
                    <?php
                        if(!empty($_POST['search_log'])){
                            $activity_logs_query = "SELECT * FROM activity_logs WHERE DATE(log_date) = '{$_POST['search_log']}' ORDER BY log_date DESC LIMIT 20";
                        }else{
                            $activity_logs_query = "SELECT * FROM activity_logs ORDER BY log_date DESC LIMIT 20";
                        }
                        // Execute the query
                        $activity_logs = mysqli_query($conn, $activity_logs_query);
                        // Indication of how many rows or result
                        echo "Displayed ".mysqli_num_rows($activity_logs)." results.";
                        // Iterate every rows
                        while ($rows = mysqli_fetch_assoc($activity_logs)){
                            echo '<tr>';
                                echo '<td>'.$rows['activity_log_id'].'</td>';
                                echo '<td>'.$rows['admin_id'].'</td>';
                                echo '<td>'.$rows['operation'].'</td>';
                                echo '<td>'.$rows['log_date'].'</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>