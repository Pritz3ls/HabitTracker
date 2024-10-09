<?php
    $user_id = $_SESSION['currentUserID'];
    if(isset($_POST['start_habit'])){
        $habit_id = $_POST['habit_id'];
        
        // Make a new habit log referencing this habit
        $query = "SELECT * FROM habits WHERE id = {$habit_id}";
        $fetch_habit = mysqli_query($conn, $query);
        
        // Check if the SQL execution were sucessful
        if(!$fetch_habit){
            echo "Something went wrong";
        }

        $row = mysqli_fetch_assoc($fetch_habit);

        $last_completion = $row['last_completion'];
        $repetition_type = $row['repetition_type'];
        $custom_interval = $row['custom_interval_value'];
        
        $correctInterval = getRepetitionInterval($repetition_type, $last_completion, $custom_interval)->format('Y-m-d');
        $currentDate = date('Y-m-d');

        if($currentDate < $correctInterval){
            echo "Too soon";
            return;
        }

        // $update_query = "UPDATE habits SET last_completion = CURRENT_DATE WHERE id = {$habit_id}";
        // $update = mysqli_query($conn, $update_query);
        
        // if(!$update){
        //     echo "Update unsuccesful!";
        // }

        // $log_habit_query = "INSERT INTO habit_logs(habit_id, habit_status)
        // VALUES('{$habit_id}','complete')";
        // $log_habit = mysqli_query($conn, $log_habit_query);

        // echo "Habit Started!";
    }
    function getRepetitionInterval($repitition_type, $lastCompletion, $custom_interval){
        $interval = date_create($lastCompletion);
        switch ($repitition_type) {
            case 'daily':
                date_modify($interval,"+1 day");
                break;
            case 'weekly':
                date_modify($interval,"+1 week");
            break;
            case 'monthly':
                date_modify($interval,"+1 month");
            break;
            case 'custom':
                date_modify($interval,"+".$custom_interval." days");
            break;
        }
        return $interval;
    }
    function getWeekString($week){
        switch ($week) {
            case 0:return 'sunday'; break;
            case 1:return 'monday'; break;
            case 2:return 'tuesday'; break;
            case 3:return 'wednesday'; break;
            case 4:return 'thursday'; break;
            case 5:return 'sunday'; break;
            case 6:return 'sunday'; break;
        }
    }
    // Check for habits that are near the current date
    // $habit_query = "SELECT * FROM habits 
    // WHERE user_id = {$user_id} 
    // ORDER BY repitition_type";
    // $habits = mysqli_query($conn, $habit_query);
    
    // if(mysqli_num_rows($habits) != 0){
    //     $last_completion = $row['last_completion'];
    //     $repetition_type = $row['repetition_type'];
    //     $custom_interval = $row['custom_interval_value'];
        
    //     $correctInterval = getRepetitionInterval($repetition_type, $last_completion, $custom_interval)->format('Y-m-d');
    //     $currentDate = date('Y-m-d');
    
    //     if($currentDate < $correctInterval){
    //         echo "Too soon";
    //         return;
    //     }
    //     $habit_details = mysqli_fetch_assoc($habits);
    //     $habitName = $habit_details['habit_name'];
    //     echo "<script>var habitName = '$habitName';</script>";
    // }
?>