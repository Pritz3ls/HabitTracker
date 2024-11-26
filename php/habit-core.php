<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    // Redirect user to login page if the current session ID is empty or null
    if(empty($_SESSION['currentUserID'])){
        Header("Location: index.php");
        exit;
    }

    // Handles user inputs
    if(isset($_POST['create-board'])){
        CreateBoard();
    }
    if(isset($_POST['rename_board'])){
        RenameBoard();
    }
    if(isset($_POST['delete_board'])){
        ArchiveBoard();
    }

    if(isset($_POST['create-habit'])){
        CreateHabit();
    }
    if(isset($_POST['start_habit'])){
        ProgressHabit();
    }
    if(isset($_POST['delete_habit'])){
        ArchiveHabit();   
    }

    // Board Level
    // Handles Board Creation
    function CreateBoard(){
        global $conn;
        // Fetch data
        $userId = $_SESSION['currentUserID'];
        $board_name = $_POST['board_name'];
        if(empty($board_name)){
            echo "<body><script>Swal.fire('Invalid Inputs!', '', 'error');</script></body>";
            return;
        }

        $query = "INSERT INTO habit_board(board_name, user_id)
        VALUES('{$board_name}',$userId)";
        $executedQuery = mysqli_query($conn,$query);
        if(!$executedQuery){
            echo "Error!";
        }
        LogActivity_HabitBoard($_SESSION['currentUserID'], 'create');
    }
    function RenameBoard(){
        global $conn;
        $board_id = $_POST['board_id'];
        $new_boardname = $_POST['rename_board'];

        $query = "UPDATE habit_board SET board_name = '$new_boardname' WHERE id = $board_id";
        $executedQuery = mysqli_query($conn, $query);
        LogActivity_HabitBoard($_SESSION['currentUserID'], 'rename');
    }
    function ArchiveBoard(){
        global $conn;
        $board_id = $_POST['board_id'];
        $query = "UPDATE habit_board SET deleted_at = CURRENT_TIMESTAMP WHERE id = $board_id";
        $executedQuery = mysqli_query($conn, $query);
        LogActivity_HabitBoard($_SESSION['currentUserID'], 'delete');
    }

    // Habit Level
    // Handles Habit creation
    function CreateHabit(){
        global $conn;
        // Fetch all necessary details
        $name = $_POST['name'];
        $board_id = $_POST['board_id'];

        if(empty($_POST['repitition_type']) || empty($name)){
            echo "<body><script>Swal.fire('Invalid Inputs!', '', 'error');</script></body>";
            // echo '<script>alert("Invalid inputs, Try again.")</script>';
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
                    echo "<body><script>Swal.fire('Weekday not specified!', '', 'error');</script></body>";
                    return;
                }
                $dayofweek = $_POST['dayofweek'];
                $query = 
                "INSERT INTO habits(board_id, habit_name, repetition_type, dayofweek)
                VALUES ($board_id,'{$name}','{$repitition_type}','{$dayofweek}')";
                break;
            case 'custom':
                # code...
                $custom_interval_value = $_POST['custom_interval_value'];
                if($custom_interval_value <= 0) {
                    echo "<body><script>Swal.fire('Days not specified!', '', 'error');</script></body>";
                    return;
                }
                $query = 
                "INSERT INTO habits(board_id, habit_name, repetition_type, custom_interval_value)
                VALUES ($board_id,'{$name}','{$repitition_type}','{$custom_interval_value}')";
                break;
            default:
                # code...
                $query = 
                "INSERT INTO habits(board_id, habit_name, repetition_type)
                VALUES ($board_id,'{$name}','{$repitition_type}')";
                break;
        }

        // Execute the sql to the database
        $add_data = mysqli_query($conn, $query);
        // Check if the sql execution is successful
        if(!$add_data){
            echo "Something went wrong";
            return;
        }
        echo "<body><script>Swal.fire('Habit Added!', '', 'success');</script></body>";
        LogActivity_Habit($_SESSION['currentUserID'], 'create');
    }
    // Handles Habit Progression
    function ProgressHabit(){
        global $conn;
        
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
        $status = $row['status'];
        $weekday = getWeekIndex($row['dayofweek']);
        
        $correctInterval = getRepetitionInterval($repetition_type, $last_completion, $custom_interval)->format('Y-m-d');
        
        try {
            if($status != "started"){
                // Check if the user can complete the habit
                // If not, then return the block
                if(!isCompleteValid($repetition_type, $correctInterval, $weekday)) return;

                echo "<body><script>Swal.fire('Habit Started!', '', 'success');</script></body>";
                
                // Record the User starting the habit
                $update_query = "UPDATE habits 
                SET last_completion = CURRENT_DATE, status = 'started' 
                WHERE id = {$habit_id}";
                $update = mysqli_query($conn, $update_query);

                // Stop the code here
                return;
            }else{
                echo "<body><script>Swal.fire('Habit Completed!', '', 'success');</script></body>";

                // Update the habit last completion to current date and habit status
                $update_query = "UPDATE habits 
                SET last_completion = CURRENT_DATE, status = 'complete' 
                WHERE id = {$habit_id}";
                $update = mysqli_query($conn, $update_query);
                
                // Log the details
                $log_habit_query = "INSERT INTO habit_logs(habit_id)
                VALUES('{$habit_id}')";
                $log_habit = mysqli_query($conn, $log_habit_query);
            }
        } catch (Exception $e) {
            echo '<script>alert("Update unsuccessful! Message: '.$e.'")</script>';
            return;
        }

        // Reward the user with XP
        $user_id = $_SESSION['currentUserID'];
        $correctXP = getRewardXP($repetition_type, $custom_interval);
        $xp_query = "UPDATE users SET user_xp = user_xp + {$correctXP} WHERE id = {$user_id}";
        $xp = mysqli_query($conn, $xp_query); 
    }
    // Handles Habit Archival
    function ArchiveHabit(){
        global $conn;
        // Create a deletion query using the habit_id
        $habit_id = $_POST['habit_id'];
        $delete_query = "UPDATE habits 
        SET deleted_at = CURRENT_TIMESTAMP
        WHERE id = {$habit_id}";
        $delete = mysqli_query($conn, $delete_query);
    
        // Check if the executed query is successful
        if(!$delete){
            echo "Something went wrong!" . mysqli_connect_error($conn);
            return;
        }
        echo "<body><script>Swal.fire('Deleted Habit!', '', 'success');</script></body>";
        LogActivity_Habit($_SESSION['currentUserID'], 'delete');
    }

    // Habit Utils
    // Get how many interval to modify the next completion date
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
                    echo "<body><script>Swal.fire('Try again tomorrow.', '', 'warning');</script></body>";
                    return false;
                }
            break;
            case 'weekly':
                # Weekly format
                if($currentDate >= $correctInterval){
                    $currentDay = (int)date('w');
                    if($currentDay < $weekday){
                        echo "<body><script>Swal.fire('Try again on ".getWeekDayString($weekday).".', '', 'warning');</script></body>";
                        return false;
                    }
                }else{
                    echo "<body><script>Swal.fire('Try again next week.', '', 'warning');</script></body>";
                    return false;
                }
            break;
            default:
                # Monthly, and Custom
                if($currentDate < $correctInterval){
                    echo "<body><script>Swal.fire('Try again some time.', '', 'warning');</script></body>";
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
    // Return the Weekday string
    function getWeekDayString($index){
        switch ($index) {
            case 0:return 'Sunday'; break;
            case 1:return 'Monday'; break;
            case 2:return 'Tuesday'; break;
            case 3:return 'Wednesday'; break;
            case 4:return 'Thursday'; break;
            case 5:return 'Friday'; break;
            case 6:return 'Saturday'; break;
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