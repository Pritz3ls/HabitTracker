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
    <script defer src="js/navbar.js"></script>

    <!-- Load  -->
    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">

    <!-- Disconnect notification js for now -->
    <!-- <script defer src="js/notification.js"></script> -->
    
    <link rel="stylesheet" href="css/palette.css">
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
            <a href="testHabit.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" ><path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
                <p>Home</p>
            </a>
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h240v-560H200v560Zm320 0h240v-280H520v280Zm0-360h240v-200H520v200Z"/></svg>
                <p>Dashboard</p>
            </a>
            <a href="testLeaderBoard.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M280-120v-80h160v-124q-49-11-87.5-41.5T296-442q-75-9-125.5-65.5T120-640v-40q0-33 23.5-56.5T200-760h80v-80h400v80h80q33 0 56.5 23.5T840-680v40q0 76-50.5 132.5T664-442q-18 46-56.5 76.5T520-324v124h160v80H280Zm0-408v-152h-80v40q0 38 22 68.5t58 43.5Zm200 128q50 0 85-35t35-85v-240H360v240q0 50 35 85t85 35Zm200-128q36-13 58-43.5t22-68.5v-40h-80v152Zm-200-52Z"/></svg>
                <p>Leaderboard</p>
            </a>
            <a href="testAccountSettings.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/></svg>
                <p>Settings</p>
            </a>
            <a href="php/user-logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                <p>Logout</p>
            </a>
        </div>
    </div>

    <!-- Board Wrapper -->
    <div class="board-wrapper">
        <?php
            $query = "SELECT * FROM habit_category";
            $executed_query = mysqli_query($conn, $query);
            // There is no habit board to begin with
            if(mysqli_num_rows($executed_query) == 0){
                $create_new_board = "INSERT INTO habit_category(user_id, category_name)
                VALUES({$_SESSION['currentUserID']}, 'New Board')";
                $executed_new_board = mysqli_query($conn, $create_new_board);
            }
            // Habit Boards
            while($row = mysqli_fetch_assoc($executed_query)){
                $category_id = $row['id'];
                // Habit Maker
                echo '<div class="habit-category-container">';
                    echo "<p class='board-name'>{$row['category_name']}</p>";
                    echo '
                        <div class="habit-maker">
                        <!-- Habit Maker Container -->
                            <form action="testHabit.php" method="post" class="habit-maker">
                                <input type="number" name="category_id" value='.$category_id.' hidden>
                                <label for="name" method="post">Name</label>
                                <div class="habit-name-submit">
                                    <input type="text" name="name" placeholder="Habit name" required>
                                    <input type="submit" name="create" value="/">
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
                    ';
                    
                    // Habits
                    // Retrieve the current User ID that logged in
                    $user_id = $_SESSION['currentUserID'];
                    $query = "SELECT * FROM habits WHERE category_id = {$category_id} AND deleted_at IS NULL";
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
                                        echo '<input type="submit" name = "start_habit" value="Start">';
                                        echo '<input type="submit" name = "delete_habit" value="Delete">';
                                        echo '<input type="hidden" name = "habit_id" value='.$habit_id.'>';
                                    echo '</div>';
                            echo "</form>";
                        };
                    echo '</div>';
                echo '</div>';
            }

            // Create new board
            echo '
                <div class="create-new-category">
                    <form action="" method="post">
                        <p>Create New Board</p>
                        <div class="name-submit">
                            <input type="text" name="board_name" placeholder="Board Name">
                            <input type="submit" value="/">
                        </div>
                    </form>
                </div>
            ';
        ?>
    </div>
</body>
</html>