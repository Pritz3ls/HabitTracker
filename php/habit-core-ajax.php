<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include 'db.php';

    // Handles user inputs
    if(isset($_POST['fetch_board'])){
        Fetch_Board();
    }
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
            echo "<script>alert('Invalid inputs!')</script>";
            return;
        }

        $query = "INSERT INTO habit_board(board_name, user_id)
        VALUES('{$board_name}',$userId)";
        $executedQuery = mysqli_query($conn,$query);
        if(!$executedQuery){
            echo "Error!";
        }
    }
    function RenameBoard(){
        global $conn;
        $board_id = $_POST['board_id'];
        $new_boardname = $_POST['rename_board'];

        $query = "UPDATE habit_board SET board_name = '$new_boardname' WHERE id = $board_id";
        $executedQuery = mysqli_query($conn, $query);
    }
    function ArchiveBoard(){
        global $conn;
        $board_id = $_POST['board_id'];
        $query = "UPDATE habit_board SET deleted_at = CURRENT_TIMESTAMP WHERE id = $board_id";
        $executedQuery = mysqli_query($conn, $query);
    }
    function Fetch_Board(){
        global $conn;
        $user_id = $_SESSION['currentUserID'];
        $query = "SELECT * FROM habit_board WHERE user_id = {$user_id} AND deleted_at IS NULL";
        $executed_query = mysqli_query($conn, $query);
        // Habit Boards
        while($row = mysqli_fetch_assoc($executed_query)){
            $board_id = $row['id'];
            // Habit Maker
            ?>
            <div class="habit-category-container">
                <div class="board-detail">
                    <form method="post">
                        <input type="hidden" name="board_id" value="<?php echo $board_id?>">
                        <input type="text" class="rename-board" name="rename_board" id='<?php echo $board_id?>' value="<?php echo $row['board_name']?>">
                    </form>
                    <form method="post">
                        <input type="hidden" name="board_id" value="<?php echo $board_id?>">
                        <button type="submit" name="delete_board"><i class="material-icons">delete</i></button>
                    </form>
                </div>

                <div class="habit-maker">
                    <!-- Habit Maker Container -->
                    <form action="" method="post" class="habit-maker">
                        <input type="number" name="board_id" value='<?php echo $board_id?>' hidden>
                        <label for="name" method="post">Name</label>
                        <div class="habit-name-submit">
                            <input type="text" name="name" placeholder="Habit name" required>
                            <button type="submit" name="create-habit">
                                <i class="material-icons">check</i>
                            </button>
                        </div>

                        <div class="habit-option-wrapper">
                            <div class="repetition-type-container">
                                <select name="repitition_type" id="repitition_type">
                                    <option disabled selected hidden>Repetition Type</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="custom">Custom</option>
                                </select>  
                            </div>
                            
                            <!-- Custom Format -->
                            <div id="custom_repitition_value" style="display:none;">
                                <input type="number" name="custom_interval_value" placeholder="Every # days" min="1" max="999">
                            </div>

                            <!-- Weekly Format -->
                            <div id="dayofweek" style="display:none;">
                                <select name="dayofweek">
                                    <option disabled selected hidden>Day Of Week</option>
                                    <option value="sunday">Sunday</option>
                                    <option value="monday">Monday</option>
                                    <option value="tuesday">Tuesday</option>
                                    <option value="wednesday">Wednesday</option>
                                    <option value="thursday">Thursday</option>
                                    <option value="friday">Friday</option>
                                    <option value="saturday">Saturday</option>
                                </select>  
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                // Habits
                // Retrieve the current User ID that logged in
                $query = "SELECT * FROM habits 
                    LEFT JOIN habit_logs ON habit_logs.log_id = habits.id
                    WHERE board_id = {$board_id} AND deleted_at IS NULL";
                $view_habits = mysqli_query($conn, $query);
                echo '<div class="habits-container">';
                    // Control
                    if(!$view_habits){return;}
                    while($row = mysqli_fetch_assoc($view_habits)){
                        echo '<form action="" method="post" class="habit">';
                            $habit_id = $row['id'];
                            $habit_name = $row['habit_name'];
                            $repetition_type = $row['repetition_type'];
                            $custom_interval_value = $row['custom_interval_value'];
                            $dayofweek = $row['dayofweek'];
                            $last_completion = $row['last_completion'];
                            $status = $row['status'];
                            // Start Button
                                echo '<div class="habit-details">';
                                    echo "<p><b>{$habit_name}</b></p>";
                                    if($repetition_type == 'custom'){
                                        echo "<p>{$repetition_type} | Every {$custom_interval_value} days</p>";
                                    }else if($repetition_type == 'weekly'){
                                        echo "<p>{$repetition_type} | {$dayofweek}</p>";
                                    }else{
                                        echo "<p>{$repetition_type}</p>";
                                    }
                                echo '</div>';
                                echo '<div class="habit-control">';
                                    echo '<button type="submit" name = "start_habit">';
                                        if($status == "started"){
                                            echo '<i class="material-icons">stop_circle</i>';
                                        }else{
                                            echo '<i class="material-icons">play_circle</i>';
                                        }
                                    echo '</button>';
                                    echo '<button type="submit" name = "delete_habit"><i class="material-icons">delete</i></button>';
                                    echo '<input type="hidden" name = "habit_id" value='.$habit_id.'>';
                                echo '</div>';
                        echo "</form>";
                    };
                echo '</div>';
            echo '</div>';
        }
    }

    // Habit Level
    // Handles Habit creation
    function CreateHabit(){
        global $conn;
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
                "INSERT INTO habits(board_id, habit_name, repetition_type, dayofweek)
                VALUES ($board_id,'{$name}','{$repitition_type}','{$dayofweek}')";
                break;
            case 'custom':
                # code...
                $custom_interval_value = $_POST['custom_interval_value'];
                if($custom_interval_value <= 0) {
                    echo '<script>alert("Days not specified.")</script>';
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
        echo '<script>alert("Habit Data added")</script>';
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

                echo '<script>alert("Habit Started!")</script>';
                
                // Record the User starting the habit
                $update_query = "UPDATE habits 
                SET last_completion = CURRENT_DATE, status = 'started' 
                WHERE id = {$habit_id}";
                $update = mysqli_query($conn, $update_query);

                // Stop the code here
                return;
            }else{
                echo '<script>alert("Habit Completed!")</script>';

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
                    echo '<script>alert("Try again tomorrow")</script>';
                    return false;
                }
            break;
            case 'weekly':
                # Weekly format
                if($currentDate >= $correctInterval){
                    $currentDay = (int)date('w');
                    if($currentDay < $weekday){
                        echo '<script>alert("Try again on '.getWeekDayString($weekday).'.")</script>';
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