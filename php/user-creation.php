<?php
    session_start();
    // Handles User Creation
    if(isset($_POST['create'])){
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
    }
?>