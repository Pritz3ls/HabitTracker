<?php
    require "php/db.php";
    include "php.utils/activity-logging.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/navbar.js"></script>
    
    <!-- Load  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script defer src="js/spinner.js"></script>
    <link rel="stylesheet" href="css/spinner.css">

    <link rel="stylesheet" href="css/palette.css"> 
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/leaderboard.css?v=<?php echo time(); ?>">
    <title>habere | Leaderboard</title>
</head>
<body>
    <!-- Spinner -->
    <div id="loading" class="loading">
        <div class="spinner"></div>
    </div>
    
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
    
    <!-- Leaderboard table -->
    <h1 class="leaderboard-tag"><b>LEARDERBOARD</b></h1>
    <table>
        <thead>
            <th>Rank</th>
            <th>Username</th>
            <th>XP</th>
        </thead>
        <tbody>
            <?php
                $leaderboard_query = "SELECT user_name, user_xp FROM users
                WHERE user_type = 'client' AND deleted_at IS NULL
                ORDER BY user_xp DESC LIMIT 10";
                $leaderboard = mysqli_query($conn, $leaderboard_query);
                $rank = 1;
                while ($item = mysqli_fetch_assoc($leaderboard)) {
                    echo '<tr>';
                        echo '<td>'.$rank.'</td>';
                        echo '<td>';
                            // Add flame effect for rank 1
                            if ($rank == 1) {
                                echo '<div class="flame"></div>';
                            }
                        echo $item['user_name'].'</td>';
                        echo '<td>'.$item['user_xp'].'</td>';
                        $rank += 1;
                    echo '</tr>';
                }
            ?>
        </tbody>
   </table>
    
</body>
</html>