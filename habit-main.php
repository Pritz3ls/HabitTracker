<?php 
    require "php/db.php";
    include "php.utils/activity-logging.php";
    include "php/habit-core.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/habit-dropdown.js"></script>
    <script defer src="js/navbar.js"></script>

    <!-- Load  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script defer src="js/motivation.js"></script>
    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">

    <link rel="stylesheet" href="css/palette.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/habit.css?v=<?php echo time(); ?>">
    <title>habere | Main</title>
</head>
<!-- save this for later onload="notif()" -->
<body>
    <!-- Spinner -->
    <div id="loading" class="loading">
        <div class="spinner"></div>
    </div>

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

    <!-- Board Wrapper -->
    <div class="board-wrapper">
        <?php
            $user_id = $_SESSION['currentUserID'];
            $query = "SELECT * FROM habit_board WHERE user_id = {$user_id}";
            $executed_query = mysqli_query($conn, $query);
            // Habit Boards
            while($row = mysqli_fetch_assoc($executed_query)){
                $board_id = $row['id'];
                // Habit Maker
                ?>
                <div class="habit-category-container">
                    <p class='board-name'><?php echo $row['board_name']?></p>
                    <div class="habit-maker">
                        <!-- Habit Maker Container -->
                        <form action="" method="post" class="habit-maker">
                            <input type="number" name="board_id" value='<?php echo $board_id?>' hidden>
                            <label for="name" method="post">Name</label>
                            <div class="habit-name-submit">
                                <input type="text" name="name" placeholder="Habit name" required>
                                <button type="submit" name="create-habit">
                                    <i class="material-icons">check</i>
                                </button>
                            </div>

                            <div class="habit-option-wrapper">
                                <div class="repetition-type-container">
                                    <select name="repitition_type" id="repitition_type">
                                        <option disabled selected hidden>Repetition Type</option>
                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="custom">Custom</option>
                                    </select>  
                                </div>
                                
                                <!-- Custom Format -->
                                <div id="custom_repitition_value" style="display:none;">
                                    <input type="number" name="custom_interval_value" placeholder="Every # days" min="1" max="999">
                                </div>

                                <!-- Weekly Format -->
                                <div id="dayofweek" style="display:none;">
                                    <select name="dayofweek">
                                        <option disabled selected hidden>Day Of Week</option>
                                        <option value="sunday">Sunday</option>
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                    </select>  
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    // Habits
                    // Retrieve the current User ID that logged in
                    $query = "SELECT * FROM habits 
                        LEFT JOIN habit_logs ON habit_logs.log_id = habits.id
                        WHERE board_id = {$board_id} AND deleted_at IS NULL";
                    $view_habits = mysqli_query($conn, $query);
                    echo '<div class="habits-container">';
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
                                $status = $row['status'];
                                // Start Button
                                    echo '<div class="habit-details">';
                                        echo "<p><b>{$habit_name}</b></p>";
                                        if($repetition_type == 'custom'){
                                            echo "<p>{$repetition_type} | Every {$custom_interval_value} days</p>";
                                        }else if($repetition_type == 'weekly'){
                                            echo "<p>{$repetition_type} | {$dayofweek}</p>";
                                        }else{
                                            echo "<p>{$repetition_type}</p>";
                                        }
                                    echo '</div>';
                                    echo '<div class="habit-control">';
                                        echo '<button type="submit" name = "start_habit">';
                                            if($status == "started"){
                                                echo '<i class="material-icons">stop_circle</i>';
                                            }else{
                                                echo '<i class="material-icons">play_circle</i>';
                                            }
                                        echo '</button>';
                                        echo '<button type="submit" name = "delete_habit"><i class="material-icons">delete</i></button>';
                                        echo '<input type="hidden" name = "habit_id" value='.$habit_id.'>';
                                    echo '</div>';
                            echo "</form>";
                        };
                    echo '</div>';
                echo '</div>';
            }
        ?>
        <!-- Create new board -->
        <div class="create-new-category">
            <form action="" method="post">
                <p>Create New Board</p>
                <div>
                    <input type="text" name="board_name" placeholder="New Board Name">
                    <button type="submit" name="create-board">
                        <i class="material-icons">check</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>