<?php include "php/db.php"?>
<?php include "php/admin.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/navbar.js"></script>
    <script defer src="js/logout.js"></script>
    
    <!-- i will disconnect the style for the admin, as i have plans for the look -->
    <!-- <link rel="stylesheet" href="css/dashboard-admin.css">  -->
    
    <link rel="stylesheet" href="css/(DEBUG)admin-dashboard.css?v=<?php echo time(); ?>"> 
    <link rel="stylesheet" href="css/popup.css?v=<?php echo time(); ?>"> 
    <title>habere | Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <div><button type="button" onclick="burgir()">Burgir Menu</button></div>
    <!-- Navigation Bar -->
    <div class="navbar" id="navbar">
        <div class="navbar_logo"></div>
        <div class="navbar_items">
            <div>
                <button type="button" onclick="burgir()">Close Menu</button>
            </div>
            <a href="testDashboard-Admin.php">Dashboard</a><br>
            <a href="">Account Settings</a><br>
            <div>
                <input type="button" value="logout" onclick="logout();">
            </div>
        </div>
    </div>
    <!-- Tables -->
    <div class="table-wrapper">
        <h2>Users</h2>
        
        <!-- Search for user table -->
        <form action="" method="post">
            <div>
                <label for="search_user">Search User</label>
                <input type="text" name="search_user" id="">
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

                        $users = mysqli_query($conn, $query);
                        echo "Displayed ".mysqli_num_rows($users)." results.";
                        while($row = mysqli_fetch_assoc($users)){
                            echo '<form action="" method="post">';
                                $user_id = $row['id'];
                                $username = $row['user_name'];
                                $password = $row['password'];
                                $phonenumber = $row['phone_number'];
                                $account_created = $row['account_created_at'];

                                echo "<tr>";
                                    echo "<td>".$user_id."</td>";
                                    echo "<td>".$username."</td>";
                                    echo "<td>".$password."</td>";
                                    echo "<td>".$phonenumber."</td>";
                                    echo "<td>".$account_created."</td>";
                                    echo '<td>';
                                        echo '<input type="submit" name="edit" value="edit">';
                                        echo '<input type="submit" name="delete" value="delete">';
                                        echo '<input type="hidden" name="selectedUserID" value='.$user_id.'>';
                                    echo '</td>';
                                echo "</tr>";
                            echo "</form>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        
        <h2>Logs</h2>
        
        <!-- Search for activity logs table -->
        <form action="" method="post">
            <div>
                <label for="search_logs">Search Logs</label>
                <input type="date" name="search_log" id="">
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
                            $activity_logs_query = "SELECT * FROM activity_logs WHERE DATE(log_date) = '{$_POST['search_log']}' ORDER BY log_date DESC LIMIT 2  0";
                        }else{
                            $activity_logs_query = "SELECT * FROM activity_logs ORDER BY log_date DESC LIMIT 20";
                        }
                        $activity_logs = mysqli_query($conn, $activity_logs_query);
                        // Iterate every rows
                        echo "Displayed ".mysqli_num_rows($activity_logs)." results.";
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