<?php
    $user_id = $_SESSION['currentUserID'];
    if(isset($_POST['start_habit'])){
        $habit_id = $_POST['habit_id'];
        
        // Make a new habit log referencing this habit
        $query = "SELECT * FROM habits WHERE id = {$habit_id}";
        $fetch_habit = mysqli_query($conn, $query);
        
        // Check if the SQL execution were sucessful
        if(!$fetch_habit){
            echo '<script>alert("Something went wrong")</script>';
            return;
        }

        $row = mysqli_fetch_assoc($fetch_habit);

        $last_completion = $row['last_completion'];
        $repetition_type = $row['repetition_type'];
        $custom_interval = $row['custom_interval_value'];
        $weekday = getWeekIndex($row['dayofweek']);
        
        $correctInterval = getRepetitionInterval($repetition_type, $last_completion, $custom_interval)->format('Y-m-d');
        
        // Check if the user can complete the habit
        // If not, then return the block
        if(!isCompleteValid($repetition_type, $correctInterval, $weekday)) return;

        // Update the habit last completion to current date
        $update_query = "UPDATE habits SET last_completion = CURRENT_DATE WHERE id = {$habit_id}";
        $update = mysqli_query($conn, $update_query);
        
        // If it's unsuccessful
        if(!$update){
            echo '<script>alert("Update unsuccessful!")</script>';
            return;
        }

        // Record the User completing the habit
        $log_habit_query = "INSERT INTO habit_logs(habit_id, habit_status)
        VALUES('{$habit_id}','complete')";
        $log_habit = mysqli_query($conn, $log_habit_query);

        // Reward the user with XP
        $correctXP = getRewardXP($repetition_type, $custom_interval);
        $xp_query = "UPDATE users SET user_xp = user_xp + {$correctXP} WHERE id = {$user_id}";
        $xp = mysqli_query($conn, $xp_query); 

        echo '<script>alert("Habit Started")</script>';
    }

    // Get modified date using the repetition type
    function getRepetitionInterval($repetition_type, $lastCompletion, $custom_interval){
        $interval = date_create($lastCompletion);
        switch ($repetition_type){
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

    // Check if the habit is valid to complete in todays date
    function isCompleteValid($repetition_type, $correctInterval, $weekday){
        $currentDate = date('Y-m-d');
        switch ($repetition_type) {
            case 'daily':
                # Daily format
                if($currentDate < $correctInterval){
                    echo '<script>alert("Try again tomorrow")</script>';
                    return false;
                }
            break;
            case 'weekly':
                # Weekly format
                if($currentDate > $correctInterval){
                    $currentDay = (int)date('w');
                    if($currentDay < $weekday){
                        echo '<script>alert("Try again on '.$weekday.'.")</script>';
                        return false;
                    }
                }else{
                    echo '<script>alert("Try again next week")</script>';
                    return false;
                }
            break;
            default:
                # Monthly, and Custom
                if($currentDate < $correctInterval){
                    echo '<script>alert("Try again some time")</script>';
                    return false;
                }
            break;
        }
        return true;
    }

    // Return the weekday index
    function getWeekIndex($week){
        switch ($week) {
            case 'sunday':return 0; break;
            case 'monday':return 1; break;
            case 'tuesday':return 2; break;
            case 'wednesday':return 3; break;
            case 'thursday':return 4; break;
            case 'friday':return 5; break;
            case 'saturday':return 6; break;
        }
    }

    // Reward userd with valid XP
    function getRewardXP($repetition_type, $custom_interval = 0){
        switch ($repetition_type) {
            case 'daily':
                # Daily XP Reward: 10 
                return 10;
                break;
            case 'weekly':
                # Weekly XP Reward: 75
                return 75;
                break;
            case 'monthly':
                # Monthly XP Reward: 285
                return 285;
                break;
            case 'custom':
                # Custom XP Reward: 10
                return $custom_interval * 10;
                break;
        }
    }
?>