<?php include "php/db.php"?>
<?php include "php/user-logout.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/navbar.js"></script>
    <link rel="stylesheet" href="css/leaderboard.css?v=<?php echo time(); ?>"> 
    <title>habere | Leaderboard</title>
</head>
<body>
    <h1><b>LEARDERBOARD</b></h1>
    <div>
        <button type="button" onclick="burgir()">Burgir Menu</button>
    </div>
    <form action="" method="post">
        <div class="navbar" id="navbar">
            <div class="navbar_logo"></div>
            <div class="navbar_items">
                <div>
                    <button type="button" onclick="burgir()">Close Menu</button>
                </div>
                <!-- Test Items -->
                <a href="">Main</a><br>
                <a href="">Dashboard</a><br>
                <a href="">Leaderboard</a><br>
                <a href="">Account Settings</a><br>
                <div>
                    <input type="submit" name="logout" value="logout">
                </div>
            </div>
        </div>
    </form>
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
                ORDER BY user_xp DESC";
                $leaderboard = mysqli_query($conn, $leaderboard_query);
                $rank = 1;
                while ($item = mysqli_fetch_assoc($leaderboard)) {
                    echo '<tr>';
                        echo '<td>'.$rank.'</td>';
                        echo '<td>'.$item['user_name'].'</td>';
                        echo '<td>'.$item['user_xp'].'</td>';
                        $rank += 1;
                    echo '</tr>';
                }
            ?>
        </tbody>
   </table>
    
</body>
</html>