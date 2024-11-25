<?php
    // Handles Form Post Inputs
    if(isset($_POST['login'])){
        User_Login();
    }
    if(isset($_POST['create'])){
        User_SignUp();
    }
    if(isset($_POST['verify'])){
        VerifyUser('true');
    }

    // Handles Login
    function User_Login(){
        global $conn;
        // Fetch CAPTCHA input from the user and the generated CAPTCHA value
        $enteredCaptcha = $_POST['captchaInput'];
        $generatedCaptcha = $_POST['hiddenCaptcha'];
        
        // Check if CAPTCHA matches
        // CAPTCHA is incorrect, show an error message and return
        if ($enteredCaptcha != $generatedCaptcha) {
            echo "<div class='error-message'><h3>Incorrect CAPTCHA!!</h3></div>";
            return;
        }
        
        // Handles User Login
        // Fetch all required information
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Fetch if the user exists
        // If the user doesn't exist, throw an error
        $user_login_query = "SELECT * FROM `users` 
        WHERE user_name = '{$username}' AND password = '{$password}' AND deleted_at IS NULL";
        $user_found = mysqli_query($conn, $user_login_query);
        
        // Check if the sql execution is successful
        if(!$user_found){
            echo "Something went wrong!" . mysqli_connect_error($conn);
            return;
        }
        
        if(mysqli_num_rows($user_found) == 0){
            echo "<div class='error-message'><h3>Wrong Username or Password!</h3></div>";
            return;
        }

        // Fetch all the rows from executed query
        $row = mysqli_fetch_assoc($user_found);
        if($row['prefer_2FA'] == 'true'){
            Header('Location: otp-authentication.php');
            $_SESSION['tempVerifyUser'] = $row['id'];
            return;
        }else{
            VerifyUser('false', $row['id']);
            return;
        }
    }

    // Handles Signup
    function User_SignUp(){
        global $conn;
        // Fetch CAPTCHA input from the user and the generated CAPTCHA value
        $enteredCaptcha = $_POST['captchaInput'];
        $generatedCaptcha = $_POST['hiddenCaptcha'];
        $password_strength = (int)$_POST['strIndex'];
        
        // Check if CAPTCHA matches
        // CAPTCHA is incorrect, show an error message and return
        if ($enteredCaptcha != $generatedCaptcha) {
            echo "<div class='error-message'><h3>Incorrect CAPTCHA!</h3></div>";
            return;
        }
        
        // Password too weak
        // Alert the user that the password it too weak
        if($password_strength < 1){
            echo "<div class='error-message'><h3>Password too weak!</h3></div>";
            return;
        }

        // Handles User Sign up
        // Fetch all required information
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // For debugging purpose
        // $user_type = $_POST['user_type'];
        
        // Validation of Email Address
        // If email address is used, throw an error
        $phone_validation_query = "SELECT COUNT(*) email_valid FROM `users` WHERE email = '{$email}'";
        $user_valid = mysqli_query($conn, $phone_validation_query);
        
        $row = mysqli_fetch_assoc($user_valid);
        if($row['email_valid'] == 1){
            echo "<div class='error-message'><h3>This email is already used.</h3></div>";
            return;
        }

        $query = "INSERT INTO users(user_name, email, password)
        VALUES('{$username}','{$email}','{$password}')";

        $add_data = mysqli_query($conn, $query);

        // Check if the sql execution is successful
        if(!$add_data){
            echo "Something went wrong!" . mysqli_connect_error($conn);
            return;
        }

        // Save the current User ID
        $fetch_id_query = "SELECT id FROM `users` WHERE email = '{$email}'";
        $fetch_id = mysqli_query($conn, $fetch_id_query);
        $fetch = mysqli_fetch_assoc($fetch_id);
        $_SESSION['currentUserID'] = $fetch['id'];
        
        Header('Location: habit-main.php');
    }
    
    // Handles Verification
    function VerifyUser($tfa = 'false', $id = 0){
        global $conn;
        if($tfa = 'true'){
            $otpinput = $_POST['otpinput'];
            $sentOTP = $_SESSION['tempOTP'];
            if($sentOTP != $otpinput){
                echo "<script>alert('Wrong OTP!')</script>";
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
        
        // Log the activity
        LogActivity_Signin($id);

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