<?php
    session_start();
    // Redirect user to login page if the current session ID is empty or null
    if(empty($_SESSION['currentUserID'])){
        Header("Location: testLanding.php");
        exit;
    }
    // Edit Function
    // Check what button are picked or clicked
    if(isset($_POST['edit'])){
        $userID = $_POST['selectedUserID'];
        $fetch_user_query = "SELECT * FROM users WHERE id = {$userID}";
        $fetch_user = mysqli_query($conn, $fetch_user_query);
        $rows = mysqli_fetch_assoc($fetch_user);
        // Create a popup
        echo '<div class="popup-container">';
            echo '<form action="" method="post" class=popup>';
                // Include the selected userID
                echo '<input type="hidden" name="selectedUserID" value='.$userID.'>';
                // Inputs for admin
                // Username
                echo '<div>';
                    echo '<label for="edit_username">Username</label>';
                    echo '<input type="text" name="edit_username" value='.$rows['user_name'].'>';
                echo '</div>';
                
                // Password
                echo '<div>';
                    echo '<label for="edit_password">Password</label>';
                    echo '<input type="text" name="edit_password" value='.$rows['password'].'>';
                echo '</div>';
                
                // Phonenumber
                echo '<div>';
                    echo '<label for="edit_phonenumber">Phonenumber</label>';
                    echo '<input type="text" name="edit_phonenumber" value='.$rows['phone_number'].'>';
                echo '</div>';
                
                echo '<div class="form_btns">';
                    echo '<input type="submit" name="edit_cancel" value="Cancel">';
                    echo '<input type="submit" name="edit_done" value="Done">';
                echo '</div>';
            echo '</form>';
        echo '</div>';
    }
        
    // Popup edit function
    if(isset($_POST['edit_done'])){
        $userID = $_POST['selectedUserID'];
        
        // Inputs
        $username = $_POST['edit_username'];
        $password = $_POST['edit_password'];
        $phonenumber = $_POST['edit_phonenumber'];
        
        $update_query = "UPDATE users 
        SET user_name = '{$username}', password = '{$password}', phone_number = '{$phonenumber}' 
        WHERE id = {$userID}";

        // Execute the query
        $update = mysqli_query($conn, $update_query);
        // Check if the exection is succesful?
        if(!$update){
            echo "Update Unsucessful!";
            return;
        }

        $admin_id = $_SESSION['currentUserID'];
        $operation_message = LOG_ACTIVITY(0, $userID);
        
        // Create the log
        $log_query = "INSERT INTO activity_logs(admin_id, operation, log_date)
        VALUES({$admin_id}, '{$operation_message}', CURRENT_TIMESTAMP)";
        // Execute the log query
        $log = mysqli_query($conn, $log_query);

        echo '<script>alert('.$operation_message.');</script>';
    }

    // Delete function
    // Check what button are picked or clicked
    if(isset($_POST['delete'])){
        $userID = $_POST['selectedUserID'];
        // Put the user on temporary deletion
        $delete_query = "UPDATE `users` SET deleted_at = CURRENT_TIMESTAMP WHERE id = {$userID}";
        $delete = mysqli_query($conn, $delete_query);
        
        // Log activity
        $admin_id = $_SESSION['currentUserID'];
        $operation_message = LOG_ACTIVITY(1, $userID);
        
        // Create the log
        $log_query = "INSERT INTO activity_logs(admin_id, operation, log_date)
        VALUES({$admin_id}, '{$operation_message}', CURRENT_TIMESTAMP)";
        // Execute the log query
        $log = mysqli_query($conn, $log_query);

        echo '<script>alert('.$operation_message.');</script>';
    }

    function LOG_ACTIVITY($index, $userID){
        // Tertiary Operator
        // Index 0 = Edited
        // Index 1 = Deleted
        return $index == 1 ? "Deleted user at index: ".$userID : "Edited user at index: ".$userID;
    }
?>