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

        // Save the current password
        $_SESSION['newPass'] = $confirm_password;

        // Fetch all the rows from executed query
        $row = mysqli_fetch_assoc($user);
        if($row['prefer_2FA'] == 'true'){
            Header('Location: otp-password-recover.php');
            $_SESSION['tempVerifyUser'] = $row['id'];
            return;
        }else{
            VerifyUser('false', $row['id']);
            return;
        }
    }
    if(isset($_POST['verify'])){
        VerifyUser('true');
    }
    // Handles Verification
    function VerifyUser($tfa = 'false', $id = 0){
        global $conn;
        if($tfa = 'true'){
            $otpinput = $_POST['otpinput'];
            $sentOTP = $_SESSION['tempOTP'];
            if($sentOTP != $otpinput){
                // echo "<script>alert('Wrong OTP!')</script>";
                echo $_SESSION['newPass'];
                return;
            }
        }
        // If the user undergo a verification, then remove the temporary index
        if(!empty($_SESSION['tempVerifyUser'])){
            // Save the current user ID
            $_SESSION['currentUserID'] = $_SESSION['tempVerifyUser'];
            $id = $_SESSION['tempVerifyUser'];
            
            unset($_SESSION['tempOTP']);
            unset($_SESSION['tempVerifyUser']);
        }else{
            // Save the current user ID
            $_SESSION['currentUserID'] = $id;
        }

        // Updates the password
        $new_password = $_SESSION['newPass'];
        $update_pass_query = "UPDATE users SET password='{$new_password}'
        WHERE id = $id";
        // Execute the query
        $update = mysqli_query($conn, $update_pass_query);
        if(!$update){
            echo "error".$update_pass_query;
            return;
        }
        
        // Log the activity
        LogActivity_PasswordRecovery($id);

        $fetch_user_type = "SELECT user_type FROM users WHERE id = $id";
        $user_found = mysqli_query($conn, $fetch_user_type);
        $row = mysqli_fetch_assoc($user_found);

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