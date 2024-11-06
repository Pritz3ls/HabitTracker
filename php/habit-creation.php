<?php 
    session_start();
    // Redirect user to login page if the current session ID is empty or null
    if(empty($_SESSION['currentUserID'])){
        Header("Location: testLanding.php");
        exit;
    }

    if(isset($_POST['create'])){
        // Retrieve the current user ID that logged in
        $user_id = $_SESSION['currentUserID'];
        
        // Fetch all necessary details
        $name = $_POST['name'];
        $board_id = $_POST['board_id'];

        if(empty($_POST['repitition_type']) || empty($name)){
            echo '<script>alert("Invalid inputs, Try again.")</script>';
            return;
        }
        
        $repitition_type = $_POST['repitition_type'];

        /*
            IF CONDITION
            Check if the dropdown value is custom, if not
            then proceed with non-custom habit
        */
        switch ($repitition_type) {
            case 'weekly':
                # code...
                if(empty($_POST['dayofweek'])) {
                    echo '<script>alert("Weekday not specified.")</script>';
                    return;
                }
                $dayofweek = $_POST['dayofweek'];
                $query = 
                "INSERT INTO habits(user_id, board_id, habit_name, repetition_type, dayofweek)
                VALUES ({$user_id},$board_id,'{$name}','{$repitition_type}','{$dayofweek}')";
                break;
            case 'custom':
                # code...
                $custom_interval_value = $_POST['custom_interval_value'];
                if($custom_interval_value <= 0) {
                    echo '<script>alert("Days not specified.")</script>';
                    return;
                }
                $query = 
                "INSERT INTO habits(user_id, board_id, habit_name, repetition_type, custom_interval_value)
                VALUES ({$user_id},$board_id,'{$name}','{$repitition_type}','{$custom_interval_value}')";
                break;
            default:
                # code...
                $query = 
                "INSERT INTO habits(user_id, board_id, habit_name, repetition_type)
                VALUES ({$user_id},$board_id,'{$name}','{$repitition_type}')";
                break;
        }

        // Execute the sql to the database
        $add_data = mysqli_query($conn, $query);
        
        // Check if the sql execution is successful
        if(!$add_data){
            echo '<script>alert("Something went wrong!'.mysqli_connect_error($conn).'")</script>';
        }else{
            echo '<script>alert("Habit Data added")</script>';
        }
    } 
?>