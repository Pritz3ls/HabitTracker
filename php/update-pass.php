<?php    
    // Update password of the user
    if(isset($_POST['forgotPass'])){
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $password_strength = (int)$_POST['strIndex'];

        // Password too weak
        // Alert the user that the password it too weak
        if($password_strength < 1){
            echo "<div class='error-message'><h3>Password too weak!</h3></div>";
            return;
        }

        // Check if the two passwords are matched
        if($new_password != $confirm_password){
            echo "<div class='error-message'><h3>Password not matched!</h3></div>";
            return;
        }
        
        $user_query = "SELECT * FROM `users` WHERE email = '{$email}'";
        // Execute the query
        $user = mysqli_query($conn, $user_query);

        // Check if the SQL execution is succesful
        if(!$user){
            echo "Something went wrong!" . mysqli_connect_error($conn);
            return;
        }
        
        // Check if the user exists using the input username
        if(mysqli_num_rows($user) == 0){
            echo "<div class='error-message'><h3>Wrong Phone Number!</h3></div>";
            return;
        }

        /*  ## INTEGRATION ##
            SMS Authentication goes here
            Send an OTP request to phone number
        */

        // Update the users password
        $update_pass_query = "UPDATE `users` SET password='{$new_password}'
        WHERE email = '{$email}'";
        // Execute the query
        $update = mysqli_query($conn, $update_pass_query);
        
        // Check if the execution is unsuccesful?
        if(!$update){
            echo "Update unsuccessful!" . mysqli_connect_error($conn);
            return;    
        }
        
        // Create a query, that selects the user type
        $client_type_query = "SELECT id,user_type FROM users WHERE email = '{$email}'";
        // Execute query
        $client_type = mysqli_query($conn, $client_type_query);

        // Fetch all the rows from executed query
        $row = mysqli_fetch_assoc($client_type);

        // Save the current user ID
        $_SESSION['currentUserID'] = $row['id'];

        LogActivity_PasswordRecovery($row['id']);

        // Divert the user to their respective pages
        // Two users are expected, Client and Admin
        if($row['user_type'] == 'client'){
            Header('Location: user-dashboard.php');  
            exit;
        }else{ /* Admin */
            Header('Location: admin-dashboard.php');  
            exit;
        }
    }
?>