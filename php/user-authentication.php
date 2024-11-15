<?php
    // Handles Form Post Inputs
    if(isset($_POST['login'])){
        User_Login();
    }
    if(isset($_POST['create'])){
        User_SignUp();
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
        
        // Save the current user ID
        $_SESSION['currentUserID'] = $row['id'];

        LogActivity_Signin($row['id']);

        // Divert the user to their respective pages
        // Two users are expected, Client and Admin    
        if($row['user_type'] == 'client'){
            Header('Location: habit-main.php');  
            exit;
        }else{ /* Admin */
            Header('Location: admin-dashboard.php');  
            exit;
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
        $phonenumber = '+63'.ltrim($_POST['phonenumber'], '0');
        $password = $_POST['password'];

        // For debugging purpose
        // $user_type = $_POST['user_type'];
        
        // Validation of Phone Number
        // If phone number is used, throw an error
        $phone_validation_query = "SELECT COUNT(*) phone_valid FROM `users` WHERE phone_number = '{$phonenumber}'";
        $user_valid = mysqli_query($conn, $phone_validation_query);
        
        $row = mysqli_fetch_assoc($user_valid);
        if($row['phone_valid'] == 1){
            echo "<div class='error-message'><h3>Phone number is already used.</h3></div>";
            return;
        }

        $query = "INSERT INTO users(user_name, phone_number, password)
        VALUES('{$username}','{$phonenumber}','{$password}')";

        $add_data = mysqli_query($conn, $query);

        // Check if the sql execution is successful
        if(!$add_data){
            echo "Something went wrong!" . mysqli_connect_error($conn);
            return;
        }

        // Save the current User ID
        $fetch_id_query = "SELECT id FROM `users` WHERE phone_number = '{$phonenumber}'";
        $fetch_id = mysqli_query($conn, $fetch_id_query);
        $fetch = mysqli_fetch_assoc($fetch_id);
        $_SESSION['currentUserID'] = $fetch['id'];
        
        Header('Location: habit-main.php');
    }
    
    // Handles Logout
    function User_Logout(){
        
    }
?>