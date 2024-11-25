<?php
    function LogActivity_Signin($id){
        global $conn;
        $message = GenerateActivityMessage('signin');

        $query = "INSERT INTO activity_logs(user_id, operation) VALUES($id, '$message')";
        $executedQuery = mysqli_query($conn, $query);
    }
    
    function LogActivity_Signout($id){
        global $conn;
        $message = GenerateActivityMessage('signout');
    
        $query = "INSERT INTO activity_logs(user_id, operation) VALUES($id, '$message')";
        $executedQuery = mysqli_query($conn, $query);
    }

    function LogActivity_Deactivation_Admin($id, $name){
        global $conn;
        $message = GenerateActivityMessage('deactivation-admin').$name;
        $query = "INSERT INTO activity_logs(user_id, operation) VALUES($id, '$message')";
        $executedQuery = mysqli_query($conn, $query);
        if(!$executedQuery){
            echo 'error';
        }
    }

    function LogActivity_UpdateInformation($id){
        global $conn;
        $message = GenerateActivityMessage('update-info');
        echo $message;
        $query = "INSERT INTO activity_logs(user_id, operation) VALUES($id, '$message')";
        $executedQuery = mysqli_query($conn, $query);
    }

    function LogActivity_GenerateReport($id){
        global $conn;
        $message = GenerateActivityMessage('report-generate');
        $query = "INSERT INTO activity_logs(user_id, operation) VALUES($id, '$message')";
        $executedQuery = mysqli_query($conn, $query);
    }

    // Habit Board Level
    function LogActivity_HabitBoard($id, $state){
        switch ($state) {
            case 'create':$message = GenerateActivityMessage('board-create');break;
            case 'rename':$message = GenerateActivityMessage('board-rename');break;
            case 'delete':$message = GenerateActivityMessage('board-delete');break;
        }
        global $conn;
        $query = "INSERT INTO activity_logs(user_id, operation) VALUES($id, '$message')";
        $executedQuery = mysqli_query($conn, $query);
    }

    // Habit Level
    function LogActivity_Habit($id, $state){
        switch ($state) {
            case 'create':$message = GenerateActivityMessage('habit-create');break;
            case 'delete':$message = GenerateActivityMessage('habit-delete');break;
        }
        global $conn;
        $query = "INSERT INTO activity_logs(user_id, operation) VALUES($id, '$message')";
        $executedQuery = mysqli_query($conn, $query);
    }

    function GenerateActivityMessage($type){
        date_default_timezone_set("Asia/Manila");
        $date = date("h:i:s A");
        switch ($type){
            case 'signin': return "User signed in at $date";
            case 'signout': return "User signed out at $date";
            case 'forgot': return "User changed password at $date";
            case 'update-info': return "Updated user information at $date";
            case 'deactivation': return "Deactivated account at $date";
            case 'deactivation-admin': return "Deactivated user account at $date, account name: ";
            case 'report-generate': return "Generated a report at $date";
            // Habit Board
            case 'board-create': return "Created a habit board at $date";
            case 'board-rename': return "Rename a habit board at $date";
            case 'board-delete': return "Deleted a habit board at $date";
            // Habit
            case 'habit-create': return "Created a habit at $date";
            case 'habit-delete': return "Delete a habit at $date";
        }
    }
?>