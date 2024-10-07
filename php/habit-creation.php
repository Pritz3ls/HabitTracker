<?php 
    session_start();
    // Redirect user to login page if the current session ID is empty or null
    if(empty($_SESSION['currentUserID'])){
        Header("Location: testLogin.php");
        exit;
    }
    if(isset ($_POST['create'])){
        // Retrieve the current user ID that logged in
        $user_id = $_SESSION['currentUserID'];
        
        // Fetch all necessary details
        $name = $_POST['name'];
        $repitition_type = $_POST['repitition_type'];
        $custom_interval_value = $_POST['custom_interval_value'];

        if(empty($name)){
            echo "Invalid inputs, Try again.";
            return;
        }

        /*
            IF CONDITION
            Check if the dropdown value is custom, if not
            then proceed with non-custom habit
        */
        if($repitition_type != 'custom'){
            $query = 
            "INSERT INTO habits(user_id, habit_name, repetition_type)
            VALUES ('{$user_id}','{$name}','{$repitition_type}')";
        }else{
            $query = 
            "INSERT INTO habits(user_id, habit_name, repetition_type, custom_interval_value)
            VALUES ('{$user_id}','{$name}','{$repitition_type}','{$custom_interval_value}')";
        }

        // Execute the sql to the database
        $add_data = mysqli_query($conn, $query);
        
        // Check if the sql execution is successful
        if(!$add_data){
            echo "Something went wrong!" . mysqli_connect_error($conn);
        }else{
            echo "Habit Data added";
        }
    } 
?>