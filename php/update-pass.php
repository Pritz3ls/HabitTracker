<?php
    // Start session
    session_start();
    
    // Update password of the user
    if(isset($_POST['forgotPass'])){
        $username = $_POST['username'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if the two passwords are matched
        if($new_password != $confirm_password){
            echo "<div class='password-error'><h3>Passwords are not matched.</h3></div>";
            return;
        }
        
        $user_query = "SELECT * FROM `users` WHERE user_name = '{$username}'";
        $user = mysqli_query($conn, $user_query);

        // Check if the SQL execution is succesful
        if(!$user){
            echo "Something went wrong!" . mysqli_connect_error($conn);
            return;
        }
        
        // Check if the user exists using the input username
        if(mysqli_num_rows($user) == 0){
            echo "<h3>Wrong Username or Password!</h3>";
            return;
        }

        // Update the users password
        $update_pass_query = "UPDATE `users` SET password='{$new_password}'
        WHERE user_name='{$username}'";
        $update = mysqli_query($conn, $update_pass_query);
        
        if(!$update){
            echo "Update unsuccessful!" . mysqli_connect_error($conn);
            return;    
        }
        
        // Fetch all the rows from executed query
        $row = mysqli_fetch_assoc($user);

        // Save the current user ID
        $_SESSION['currentUserID'] = $row['id'];

        // Divert the user to their respective pages
        // Two users are expected, Client and Admin
        if($row['user_type'] == 'client'){
            /* Client */
            Header('Location: testHabit.php');  
            exit;
        }else{
            /* Admin */
            Header('Location: testDashboard-Admin.php');  
            exit;
        }
    }
?>