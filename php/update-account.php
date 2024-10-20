<?php
    // Start a session
    session_start();

    // Update the user information
    if(isset($_POST['update_info'])){
        $password_strength = (int)$_POST['strIndex'];
        
        // Password too weak
        // Alert the user that the password it too weak
        if($password_strength < 1){
            echo "Password too weak";
            return;
        }

        $username = $_POST['username'];
        $phonenumber = $_POST['phonenumber'];
        $password = $_POST['password'];

        // Validation of Phone Number
        // If phone number is used, throw an error
        $phone_validation_query = "SELECT COUNT(*) phone_valid FROM `users` WHERE phone_number = '{$phonenumber}' AND id != {$_SESSION['currentUserID']}";
        // Execute the validation query
        $user_valid = mysqli_query($conn, $phone_validation_query);
        
        // Check if the sql found a number that matched the input
        // If yes, then throw an error that the phone number is already used
        $row = mysqli_fetch_assoc($user_valid);
        if($row['phone_valid'] == 1){
            echo "Phone number is already used.";
            return;
        }

        // Create a update query to update user information
        $update_info_query = "UPDATE users 
        SET user_name = '{$username}', phone_number = '{$phonenumber}', password = '{$password}' 
        WHERE id = {$_SESSION['currentUserID']}";

        // Execute the query
        $update_info = mysqli_query($conn, $update_info_query);

        // Check if the sql execution is successful
        if(!$update_info){
            echo "Something went wrong!" . mysqli_connect_error($conn);
            return;
        }
    }
?>