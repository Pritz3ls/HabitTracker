<?php include "php/db.php"?>
<?php include "php/user-logout.php"?>
<?php include "php/admin.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <form action="" method="post">
        <input type="submit" name="logout" value="logout" >
    </form>
    <table>
        <?php
            $query = "SELECT * FROM `users` WHERE user_type = 'client' AND deleted_at IS NULL";
            $users = mysqli_query($conn, $query);
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