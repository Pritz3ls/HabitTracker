<?php
    // Fetchh Username
    function Fetch_Username(){
        global $conn;
        global $curID;
        $query = "SELECT user_name FROM users WHERE id = $curID";
        $executedQuery = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executedQuery);
        return $data['user_name'];
    }
    
    // Registered Users
    function Fetch_RegisteredUsersByMonth($period){
        global $conn;
        // $month = date('n');
        // $val = $month - $period;
        $val = date_format($period, "Y-m-d");
        $query = "
            SELECT COUNT(*) AS totalregisteredUsers FROM users
            WHERE created_at <= '$val'
        ";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        return $data['totalregisteredUsers'];
    }

    // Active Users
    function Fetch_ActiveUsersByMonth($period){
        global $conn;
        // $month = date('n');
        // $val = $month - $period;
        $val = date_format($period, "Y-m-d");
        $query = "
            SELECT
                COUNT(*) AS total_registered_users,
                SUM(deleted_at IS NULL) AS totalActiveUsers
            FROM users
            WHERE created_at <= '$val'
        ";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        return $data['totalActiveUsers'];
    }
    function Fetch_Readings_ActiveUsers(){
        global $conn;
        $present = mysqli_query($conn,
            "SET @active_users = (
                SELECT COUNT(*) FROM users
                WHERE deleted_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)
                AND user_type = 'client'
            );"
        );
        $previous = mysqli_query($conn,
            "SET @inactive_users = (
                SELECT COUNT(*) FROM users
                WHERE deleted_at BETWEEN DATE_SUB(CURRENT_DATE, INTERVAL 2 WEEK) 
                AND DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)
                AND user_type = 'client'
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
        $color = $active_users <= $inactive_users ? "color: green" : "color: red";
        $comparison_result = $data['result'];

        return '<p style="'.$color.'">'.$percentage.'% '.$comparison_result.' last 7 days </p>';
    }

    // Habits
    function Fetch_Total_Habits(){
        global $conn;
        $query = "SELECT COUNT(*) AS total FROM habits habits WHERE deleted_at IS NULL";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        return $data['total'];
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
        
        $color = $current >= $previous ? "color: green" : "color: red";
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
        return $data['total'];
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
        $color = $current >= $previous ? "color: green" : "color: red";
        $comparison_result = $data['result'];

        return '<p style="'.$color.'">'.$percentage.'% '.$comparison_result.' last 7 days </p>';
    }

    // Custom Data
    function Fetch_CustomData($table_name, $period){
        global $conn;
        $month = date('n');
        $val = $month - $period;
        // $period -= ;
        $query = "SELECT COUNT(*) AS custom FROM {$table_name} 
            WHERE MONTH(created_at) = $val";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        return $data['custom'];
    }
    
    function Fetch_TotalsByMonth($table_name, $period){
        global $conn;
        $val = date_format($period, "Y-m-d");
        $query = "SELECT COUNT(*) AS custom FROM {$table_name} 
            WHERE created_at <= '$val'";
        $executed_query = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executed_query);
        return $data['custom'];
    }
?>