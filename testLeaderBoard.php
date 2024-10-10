<?php include "php/db.php"?>
<?php include "php/user-logout.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resource/application-icon.png" type="image/png">
    <script defer src="js/navbar.js"></script>
    <script defer src="js/leaderboards.js"></script>
    <link rel="stylesheet" href="css/leaderboard.css?v=<?php echo time(); ?>"> 
    <title>habere | Leaderboard</title>

</head>
<body>
    <h1><b>LEARDERBOARD</b></h1>
    <div>
        <button type="button" onclick="burgir()">Burgir Menu</button>
    </div>
    <div class="navbar" id="navbar">
        <div class="navbar_logo"></div>
        <div class="navbar_items">
            <div>
                <button type="button" onclick="burgir()">Close Menu</button>
            </div>
            <!-- Test Items -->
            <a href="">Main</a><br>
            <a href="">Dashboard</a><br>
            <a href="">Account Settings</a><br>
            <div>
                <input type="submit" name = "logout" value="logout">
            </div>
        </div>
    </div>
   <table id="rankingTable">
    <thead>
        <tr>
            <th>Ranking</th>
            <th>Name</th>
            <th>Habit Finished</th>
            <th>XP</th>
        </tr>
    </thead>
     <tbody>
        <tr>
            <td></td>
            <td>ian</td>
            <td>23</td>
            <td>1003</td>
           
        </tr>
        <tr>
            <td></td>
            <td>gyles</td>
            <td>130</td>
            <td>1003</td>
            
        </tr>
        <tr>
            <td></td>
            <td>prince</td>
            <td>10s0</td>
            <td>1003</td>
            
        </tr>
     </tbody>

   </table>
    
</body>
</html>