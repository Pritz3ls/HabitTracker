<?php include "php/db.php"?>
<?php include "php/habit-creation.php"?>
<?php include "php/user-logout.php"?>
<?php include "php/start-habit.php"?>
<?php include "php/delete-habit.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/habit-dropdown.js"></script>
    <script defer src="js/navbar.js"></script>
    <script defer src="js/notification.js"></script>
    <link rel="stylesheet" href="css/habit.css?v=<?php echo time(); ?>">
    <title>habere | Main</title>
</head>
<!-- save this for later onload="notif()" -->
<body>
    <!-- Form Container -->
    <form action="testHabit.php" method="post">
        <div>
            <button type="button" onclick="burgir()">burgir menu</button>
        </div>
        <div class="navbar" id="navbar">
            <div class="navbar_logo"></div>
            <div class="navbar_items">
                <!-- Test Items -->
                <a href="">Main</a><br>
                <a href="">Dashboard</a><br>
                <a href="">Account Settings</a><br>
                <div>
                    <input type="submit" name = "logout" value="logout">
                </div>
            </div>
        </div>
        
        <div>
            <label for="name" method="post">Name</label>
            <input type="text" name="name">
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
        
        <div id="custom_repitition_value" style="display:none;">
            <label for="custom_interval_value" method="post">Custom Interval Value</label>
            <input type="number" name="custom_interval_value">
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
                // Habit Div Open
                echo '<div class = "habit">';
                    echo '<form action="" method="post">';
                        $habit_id = $row['id'];
                        $habit_name = $row['habit_name'];
                        $repetition_type = $row['repetition_type'];
                        $custom_interval_value = $row['custom_interval_value'];

                        // Start Button
                            echo '<input type="submit" name = "start_habit" value="start">';
                            echo '<input type="submit" name = "delete_habit" value="delete">';
                            echo '<input type="hidden" name = "habit_id" value='.$habit_id.'>';
                            echo "<p><b>{$habit_name}</b></p>";
                            echo "<p>{$repetition_type}</p>";
                            if($repetition_type == 'custom'){
                                echo "<p>{$custom_interval_value} times</p>";
                            }
                    echo "</form>";
                echo "</div>";
                // Habit Div Close
            };
        ?>
    </div>
</body>
</html>