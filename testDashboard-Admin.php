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
    <link rel="stylesheet" href="css/popup.css"> 
    <title>habere | Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
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
                <a href="">Dashboard</a><br>
                <a href="">Activity Logs</a><br>
                <a href="">Account Settings</a><br>
                <div>
                    <input type="button" value="logout" onclick="logout();">
                </div>
            </div>
        </div>

        <div>
            <label for="search_user">Search User</label>
            <input type="text" name="search_user" id="">
            <input type="submit" name="start_search" value="Search">
        </div>
    </form>
    <table>
        <?php
            if(isset($_POST['search_user'])){
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
                        echo "<td>".$user_id."<td>";
                        echo "<td>".$username."<td>";
                        echo "<td>".$password."<td>";
                        echo "<td>".$phonenumber."<td>";
                        echo "<td>".$account_created."<td>";

                        echo '<input type="submit" name="edit" value="edit">';
                        echo '<input type="submit" name="delete" value="delete">';
                        echo '<input type="hidden" name="selectedUserID" value='.$user_id.'>';
                    echo "</tr>";
                echo "</form>";
            }
        ?>
    </table>
</body>
</html>