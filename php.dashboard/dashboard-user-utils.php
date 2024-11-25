<?php
    global $curID;
    if(empty($_SESSION['currentUserID'])){
        Header("Location: index.php");
        return;
    }
    $curID = $_SESSION['currentUserID'];

    // Fetch Username
    function Fetch_Username(){
        global $conn;
        global $curID;
        $query = "SELECT user_name FROM users WHERE id = $curID";
        $executed_query = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($executed_query);
        return $data['user_name'];
    }

    // Fetch Boards
    function Fetch_Boards(){
        global $conn;
        $query = "
            SELECT habit_board.board_name
            FROM habit_board
            WHERE habit_board.user_id = 1
        ";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($executed_query);
        return $data;
    }

    // Fetch Completed Habits
    function Fetch_Completed_Habits(){
        global $conn;
        global $curID;

        $query = "SELECT COUNT(habits.id) AS completed_habits
            FROM users
            JOIN habit_board ON users.id = habit_board.user_id
            JOIN habits ON habit_board.id = habits.board_id
            JOIN habit_logs ON habits.id = habit_logs.habit_id
            WHERE users.id = $curID";

        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        return number_format_short($data['completed_habits']);
    }

    // Fetch Total Habits
    function Fetch_Total_Habits(){
        global $conn;
        global $curID;

        $query = "
            SELECT COUNT(habits.id) AS habit_count
            FROM users
            JOIN habit_board ON users.id = habit_board.user_id
            JOIN habits ON habit_board.id = habits.board_id
            WHERE users.id = $curID AND habits.deleted_at IS NULL
        ";

        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        return number_format_short($data['habit_count']);
    }

    function Fetch_TodayHabits(){
        global $conn;
        global $curID;
        $query = "
            SELECT habits.habit_name AS name, habits.repetition_type AS repType, habits.dayofweek AS day
            FROM users
            JOIN habit_board ON users.id = habit_board.user_id
            JOIN habits ON habit_board.id = habits.board_id
            WHERE users.id = $curID  -- Filter by specific user ID
            AND habits.deleted_at IS NULL
            AND (
                -- Daily habits: Include all, as they repeat every day
                habits.repetition_type = 'daily'
                
                OR (
                    -- Weekly habits: Check if the current day of the week matches the habit's `dayofweek`
                    habits.repetition_type = 'weekly'
                    AND habits.dayofweek = DAYNAME(CURDATE())
                )
                
                OR (
                    -- Monthly habits: Check if today’s day matches the day of the month in `start_date`
                    habits.repetition_type = 'monthly'
                    AND DAY(CURDATE()) = DAY(habits.last_completion)
                )
                
                OR (
                    -- Custom habits: Check if the custom interval has passed and today is part of the schedule
                    habits.repetition_type = 'custom'
                    AND DATEDIFF(CURDATE(), habits.last_completion) % habits.custom_interval_value = 0
                )
            )
        ";
        $executed_query = mysqli_query($conn, $query);
        while($data = mysqli_fetch_assoc($executed_query)){
            $name = $data['name'];
            $repType = $data['repType'];
            $day = $data['day'];

            ?>
            <div class="item">
                <div class="details">
                    <h4><?php echo $name?></h4>
                    <p><?php 
                        $note = $repType == 'weekly' ? $day : '';
                        echo "$repType $note";
                    ?></p>
                </div>
                <div class="control">
                    <a href="habit-main.php">Go</a>
                </div>
            </div>
            <?php
        }
    }

    // Graphs
    function Fetch_GraphCustomData($period){
        global $conn;
        global $curID;
        $month = date('n');
        $val = $month - $period;
        // echo $val;
        $query = "
            SELECT COUNT(habits.id) AS completed_habits
            FROM users
            JOIN habit_board ON users.id = habit_board.user_id
            JOIN habits ON habit_board.id = habits.board_id
            JOIN habit_logs ON habits.id = habit_logs.habit_id
            WHERE users.id = $curID AND
            MONTH(habits.created_at) = $val
        ";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        return $data['completed_habits'];
    }
?>