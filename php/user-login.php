<?php
    session_start();
    
    if(isset($_POST['login'])){
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

        // Divert the user to their respective pages
        // Two users are expected, Client and Admin    
        if($row['user_type'] == 'client'){
            Header('Location: dashboard-user.php');  
            exit;
        }else{ /* Admin */
            Header('Location: testDashboard-Admin.php');  
            exit;
        }
    }
?>