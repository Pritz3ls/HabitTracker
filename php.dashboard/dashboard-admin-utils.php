<?php
    // Redirect user to login page if the current session ID is empty or null
    if(empty($_SESSION['currentUserID'])){
        Header("Location: index.php");
        exit;
    }
    $curID = $_SESSION['currentUserID'];

    // Registered Users
    function Fetch_Total_RegisteredUsers(){
        global $conn;
        $query = "SELECT COUNT(*) AS totalregisteredUsers FROM users";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        return number_format_short($data['totalregisteredUsers']);
    }
    function Fetch_Readings_RegisteredUsers(){
        global $conn;
        $present = mysqli_query($conn,
            "SET @current_read = (
                SELECT COUNT(*) FROM users
                WHERE created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)
            )"
        );
        $previous = mysqli_query($conn,
            "SET @previous_read = (
                SELECT COUNT(*) FROM users
                WHERE created_at BETWEEN DATE_SUB(CURRENT_DATE, INTERVAL 2 WEEK)
                AND DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)
            )"
        );
        $query = "
            SELECT
                @current_read AS current_read,
                @previous_read AS previous_read,
                CASE
                    WHEN @current_read > @previous_read THEN 'increase'
                    WHEN @current_read < @previous_read THEN 'decrease'
                    ELSE 'no change'
                END AS result;
        ";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        // Collects all row data
        $current = $data['current_read'];
        $previous = $data['previous_read'];

        // Stop zero divident
        $previous = $previous == 0 ? 1 : $previous;

        $percentage = round($current / $previous)*10;
        $color = $current >= $previous ? "color: #2ECC40" : "color: #e90b0b";
        $comparison_result = $data['result'];

        return '<p style="'.$color.'">'.$percentage.'% '.$comparison_result.' last 7 days </p>';
    }

    // Habits
    function Fetch_Total_Habits(){
        global $conn;
        $query = "SELECT COUNT(*) AS total FROM habits habits";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        return number_format_short($data['total']);
    }
    function Fetch_Readings_Habits(){
        global $conn;
        $present = mysqli_query($conn,
            "SET @current_read = (
                SELECT COUNT(*) FROM habits
                WHERE created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)
            )"
        );
        $previous = mysqli_query($conn,
            "SET @previous_read = (
                SELECT COUNT(*) FROM habits
                WHERE created_at BETWEEN DATE_SUB(CURRENT_DATE, INTERVAL 2 WEEK)
                AND DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)
            )"
        );
        $query = "
            SELECT
                @current_read AS current_read,
                @previous_read AS previous_read,
                CASE
                    WHEN @current_read > @previous_read THEN 'increase'
                    WHEN @current_read < @previous_read THEN 'decrease'
                    ELSE 'no change'
                END AS result;
        ";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        // Collects all row data
        $current = $data['current_read'];
        $previous = $data['previous_read'];
        
        $color = $current >= $previous ? "color: #2ECC40" : "color: #e90b0b";
        $percentage = ($current-$previous)*10;
        $comparison_result = $data['result'];

        return '<p style="'.$color.'">'.$percentage.'% '.$comparison_result.' last 7 days </p>';
    }

    // Completed Habits
    function Fetch_Completed_Habits(){
        global $conn;
        $query = "SELECT COUNT(*) AS total FROM habit_logs";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        return number_format_short($data['total']);
    }
    function Fetch_Readings_CompletedHabits(){
        global $conn;
        $present = mysqli_query($conn,
            "SET @current_read = (
                SELECT COUNT(*) FROM habit_logs
                WHERE created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)
            )"
        );
        $previous = mysqli_query($conn,
            "SET @previous_read = (
                SELECT COUNT(*) FROM habit_logs
                WHERE created_at BETWEEN DATE_SUB(CURRENT_DATE, INTERVAL 2 WEEK)
                AND DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)
            )"
        );
        $query = "
            SELECT
                @current_read AS current_read,
                @previous_read AS previous_read,
                CASE
                    WHEN @current_read > @previous_read THEN 'increase'
                    WHEN @current_read < @previous_read THEN 'decrease'
                    ELSE 'no change'
                END AS result;
        ";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        // Collects all row data
        $current = $data['current_read'];
        $previous = $data['previous_read'];

        // Stop zero divident
        $previous = $previous == 0 ? 1 : $previous;

        $percentage = round($current / $previous)*10;
        $color = $current >= $previous ? "color: #2ECC40" : "color: #e90b0b";
        $comparison_result = $data['result'];

        return '<p style="'.$color.'">'.$percentage.'% '.$comparison_result.' last 7 days </p>';
    }

    // Active Users
    function Fetch_Total_ActiveUsers(){
        global $conn;
        $query = "SELECT COUNT(*) AS total FROM users WHERE deleted_at IS NULL";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        return number_format_short($data['total']);
    }
    function Fetch_Readings_ActiveUsers(){
        global $conn;
        $present = mysqli_query($conn,
            "SET @active_users = (
                SELECT COUNT(*) FROM users
                WHERE deleted_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)
            );"
        );
        $previous = mysqli_query($conn,
            "SET @inactive_users = (
                SELECT COUNT(*) FROM users
                WHERE deleted_at BETWEEN DATE_SUB(CURRENT_DATE, INTERVAL 2 WEEK) 
                AND DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)
            );"
        );
        $query = "
            SELECT
                @active_users AS active,
                @inactive_users AS inactive,
                CASE
                    WHEN @active_users > @inactive_users THEN 'decrease'
                    WHEN @active_users < @inactive_users THEN 'increase'
                    ELSE 'no change'
                END AS result;
        ";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        // Collects all row data
        $active_users = $data['active'];
        $inactive_users = $data['inactive'];

        $percentage = round($active_users / $previous)*10;
        $color = $active_users <= $inactive_users ? "color: #2ECC40" : "color: #e90b0b";
        $comparison_result = $data['result'];

        return '<p style="'.$color.'">'.$percentage.'% '.$comparison_result.' last 7 days </p>';
    }

    // Latest Activity
    // Deprecated
    function GetLatestActivity(){
        global $conn;
        $query = "SELECT admin_id as id, operation as message, TIME(log_date) as log_time, users.user_name as admin_name
            FROM activity_logs
            INNER JOIN users ON activity_logs.admin_id = users.id
            WHERE log_date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
            ORDER BY TIME(log_date) DESC LIMIT 6";
        $executed_query = mysqli_query($conn, $query);
        return $executed_query;
    }

    // Graphs
    function Fetch_GraphCustomData($date){
        global $conn;
        // $period -= ;
        $query = "
        SELECT 
            (SELECT COUNT(*) FROM habits WHERE DATE_FORMAT(created_at, '%Y-%m') = DATE_FORMAT('$date', '%Y-%m')) AS total_habits,
            (SELECT COUNT(*) FROM habit_logs WHERE DATE_FORMAT(created_at, '%Y-%m') = DATE_FORMAT('$date', '%Y-%m')) AS total_completed_habits,
            (SELECT COUNT(*) FROM users WHERE DATE_FORMAT(created_at, '%Y-%m') = DATE_FORMAT('$date', '%Y-%m')) AS registered_users
        ";
        $data = mysqli_query($conn, $query);
        return $data;
    }

    // Fetch Username
    function Fetch_Username(){
        global $conn;
        global $curID;
        $query = "SELECT user_name FROM users WHERE id = $curID";
        $executed_query = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($executed_query);
        return $data['user_name'];
    }

    // Template
    /*
    function Template(){
        global $conn;
        $query = "";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
    }
    */
?>