<?php include "php/db.php"?>
<?php include "php/habit-creation.php"?>
<?php include "php/start-habit.php"?>
<?php include "php/delete-habit.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/habit-dropdown.js"></script>
    <script defer src="js/logout.js"></script>
    <script defer src="js/navbar.js"></script>

    <!-- Disconnect notification js for now -->
    <!-- <script defer src="js/notification.js"></script> -->
    
    <link rel="stylesheet" href="css/palette.css">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/habit.css?v=<?php echo time(); ?>">
    <title>habere | Main</title>
</head>
<!-- save this for later onload="notif()" -->
<body>
    <div class="header">
        <!-- Burger Button -->
        <button type="button" onclick="burgir();" class="burgir">=</button>
        <!-- Profile Container -->
        <?php
            $user_query = "SELECT user_name, user_xp FROM users WHERE id = {$_SESSION['currentUserID']}";
            $user = mysqli_query($conn, $user_query);
            $rows = mysqli_fetch_assoc($user);

            echo '<div class="profile-container">';
                echo "<h4>".$rows['user_name']."</h4>";
                echo "<h4>".$rows['user_xp']." XP</h4>";
            echo "</div>";
        ?>
    </div>
    
    <!-- Navigation Bar -->
    <div class="navbar" id="navbar">
        <div class="navbar_logo"></div>
        <div class="navbar_items">
            <a href="testHabit.php">Main</a>
            <a href="">Dashboard</a>
            <a href="testLeaderBoard.php">Leaderboard</a>
            <a href="testAccountSettings.php">Account Settings</a>
            <input type="button" value="Logout" onclick="logout();">
        </div>
    </div>

    <!-- Habit Form Container -->
    <form action="testHabit.php" method="post" class="habit-maker">
        <div>
            <label for="name" method="post">Name</label>
            <input type="text" name="name" placeholder="Habit name">
        </div>
                
        <div>
            <label for="repitition_type" method="post">Repitition</label>
            <select name="repitition_type" id="repitition_type">
                <option value="daily" selected>Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
                <option value="custom">Custom</option>
            </select>  
        </div>
        
        <!-- Custom Format -->
        <div id="custom_repitition_value" style="display:none;">
            <label for="custom_interval_value" method="post">Every</label>
            <input type="number" name="custom_interval_value"> Days
        </div>

        <!-- Weekly Format -->
        <div id="dayofweek" style="display:none;">
            <label for="dayofweek" method="post">Weekday</label>
            <select name="dayofweek">
                <option value="sunday" selected>Sunday</option>
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
                <option value="saturday">Saturday</option>
            </select>  
        </div>
        
        <div>
            <input type="submit" name = "create" value="Submit">
        </div>
    </form>

    <!-- View Habit -->
    <h1>Habits</h1>
    <div class="habit-container">
        <?php
            // Retrieve the current User ID that logged in
            $user_id = $_SESSION['currentUserID'];
            $query = "SELECT * FROM habits WHERE user_id = {$user_id} AND deleted_at IS NULL";
            $view_habits = mysqli_query($conn, $query);

            
            // Control
            if(!$view_habits){return;}
            while($row = mysqli_fetch_assoc($view_habits)){
                echo '<form action="" method="post" class="habit">';
                    $habit_id = $row['id'];
                    $habit_name = $row['habit_name'];
                    $repetition_type = $row['repetition_type'];
                    $custom_interval_value = $row['custom_interval_value'];
                    $dayofweek = $row['dayofweek'];
                    $last_completion = $row['last_completion'];
                    // Start Button
                        echo '<div class="details">';
                            echo "<p><b>{$habit_name}</b></p>";
                            echo "<p>{$repetition_type}</p>";
                            if($repetition_type == 'custom'){
                                echo "<p>Every {$custom_interval_value} days</p>";
                            }else if($repetition_type == 'weekly'){
                                echo "<p>{$dayofweek}</p>";
                            }
                        echo '</div>';
                        echo '<div class="control">';
                            echo '<input type="submit" name = "start_habit" value="Start">';
                            echo '<input type="submit" name = "delete_habit" value="Delete">';
                            echo '<input type="hidden" name = "habit_id" value='.$habit_id.'>';
                        echo '</div>';
                echo "</form>";
            };
        ?>
    </div>
</body>
</html>