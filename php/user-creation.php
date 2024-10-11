<?php
    session_start();
    if(isset($_POST['create'])){
        // Fetch CAPTCHA input from the user and the generated CAPTCHA value
        $enteredCaptcha = $_POST['captchaInput'];
        $generatedCaptcha = $_POST['hiddenCaptcha'];
        $password_strength = (int)$_POST['strIndex'];
        
        // Check if CAPTCHA matches
        // CAPTCHA is incorrect, show an error message and return
        if ($enteredCaptcha != $generatedCaptcha) {
            echo "Incorrect CAPTCHA!";
            return;
        }

        // Password too weak
        // Alert the user that the password it too weak
        if($password_strength < 1){
            echo "Password too weak";
            return;
        }

        // Handles User Sign up
        // Fetch all required information
        $username = $_POST['username'];
        $phonenumber = $_POST['phonenumber'];
        $password = $_POST['password'];
        $user_type = $_POST['user_type'];
        
        // Validation of Phone Number
        // If phone number is used, throw an error
        $phone_validation_query = "SELECT COUNT(*) phone_valid FROM `users` WHERE phone_number = '{$phonenumber}'";
        $user_valid = mysqli_query($conn, $phone_validation_query);
        
        $row = mysqli_fetch_assoc($user_valid);
        if($row['phone_valid'] == 1){
            echo "Phone number is already used.";
            return;
        }

        $query = "INSERT INTO users(user_name, phone_number, user_type, password)
        VALUES('{$username}','{$phonenumber}', '{$user_type}','{$password}')";

        $add_data = mysqli_query($conn, $query);

        // Check if the sql execution is successful
        if(!$add_data){
            echo "Something went wrong!" . mysqli_connect_error($conn);
            return;
        }

        // Save the current User ID
        $fetch_id_query = "SELECT * FROM `users` WHERE phone_number = '{$phonenumber}'";
        $fetch_id = mysqli_query($conn, $fetch_id_query);
        $fetch = mysqli_fetch_assoc($fetch_id);
        $_SESSION['currentUserID'] = $fetch['id'];
        
        if($user_type == 'client'){
            Header('Location: testHabit.php');  
            exit;
        }else{ /* Admin */
            Header('Location: testDashboard-Admin.php');  
            exit;
        }
       
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $password = $_POST['password'];
            if (preg_match('/.{8}/', $password) && preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password)) {
                echo "Password is strong!";
            } else {
                echo "Password is weak.";
            }
        }
    }
?>