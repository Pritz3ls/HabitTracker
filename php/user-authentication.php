<?php
    // Handles Form Post Inputs
    if(isset($_POST['login'])){
        User_Login();
    }
    if(isset($_POST['create'])){
        User_SignUp();
    }
    if(isset($_POST['user-auth'])){
        VerifyUser('true');
    }
    if(isset($_POST['verify-email'])){
        VerifyEmail();
    }

    // Handles Login
    function User_Login(){
        global $conn;

        // Unset the previous login details
        unset($_SESSION['tempOTP']);
        unset($_SESSION['tempVerifyUser']);

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

        // Handles User Signup
        // Delete the old sign up details if theres one
        unset($_SESSION['temp_username']);
        unset($_SESSION['temp_email']);
        unset($_SESSION['temp_password']);
        unset($_SESSION['tempOTP']);

        // Fetch all required information
        // Save the input data
        $_SESSION['temp_username'] = $_POST['username'];
        $_SESSION['temp_email'] = $_POST['email'];
        $_SESSION['temp_password'] = $_POST['password'];
        
        // Validation of Email Address
        // If email address is used, throw an error
        $phone_validation_query = "SELECT COUNT(*) email_valid FROM `users` WHERE email = '{$email}'";
        $user_valid = mysqli_query($conn, $phone_validation_query);
        
        $row = mysqli_fetch_assoc($user_valid);
        if($row['email_valid'] == 1){
            echo "<div class='error-message'><h3>This email is already used.</h3></div>";
            return;
        }
        
        // Redirect
        Header('Location: otp-email-verification.php');
    }
    
    // Handles Verification
    // User Authentication
    function VerifyUser($tfa = 'false', $id = 0){
        global $conn;
        if($tfa = 'true'){
            $otpinput = $_POST['otpinput'];
            $sentOTP = $_SESSION['tempOTP'];
            if($sentOTP != $otpinput){
                echo "<div class='error-message'><h3>Incorrect OTP Code!</h3></div>";
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
    // Email Verification
    function VerifyEmail(){
        global $conn;
        $otpinput = $_POST['otpinput'];
        $sentOTP = $_SESSION['tempOTP'];
        if($sentOTP != $otpinput){
            echo "<div class='error-message'><h3>Incorrect OTP Code!</h3></div>";
            return;
        }
        
        // Fetch the saved data
        $username = $_SESSION['temp_username'];
        $email = $_SESSION['temp_email'];
        $password = $_SESSION['temp_password'];

        $query = "INSERT INTO users(user_name, email, password)
        VALUES('{$username}','{$email}','{$password}')";
        
        $add_data = mysqli_query($conn, $query);

        // Check if the sql execution is successful
        if(!$add_data){
            echo "Something went wrong!" . mysqli_connect_error($conn);
            return;
        }
        
        // Login the newly created account
        $login_newAccount_query = "SELECT id FROM `users` 
        WHERE email = '{$email}' AND password = '{$password}'";
        $new_account = mysqli_query($conn, $login_newAccount_query);
        $data = mysqli_fetch_assoc($new_account);
        $id = $data['id'];

        // Save the current user ID
        $_SESSION['currentUserID'] = $id;

        // Log the activity
        LogActivity_Signup($id);

        // Delete the signup data
        unset($_SESSION['temp_username']);
        unset($_SESSION['temp_email']);
        unset($_SESSION['temp_password']);

        // Redirect user to the main page
        Header('Location: habit-main.php');
    }
?>