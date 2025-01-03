<?php
    function LogActivity_Signup($id){
        global $conn;
        $message = GenerateActivityMessage('signup');

        $query = "INSERT INTO activity_logs(user_id, operation) VALUES($id, '$message')";
        $executedQuery = mysqli_query($conn, $query);
    }

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
    }

    function LogActivity_UpdateInformation($id){
        global $conn;
        $message = GenerateActivityMessage('update-info');
        $query = "INSERT INTO activity_logs(user_id, operation) VALUES($id, '$message')";
        $executedQuery = mysqli_query($conn, $query);
    }

    function LogActivity_PasswordRecovery($id){
        global $conn;
        $message = GenerateActivityMessage('password-recover');
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
            // User Authentication
            case 'signup': return "Created an account at $date";
            case 'signin': return "User signed in at $date";
            case 'signout': return "User signed out at $date";
            case 'forgot': return "User changed password at $date";
            case 'update-info': return "Updated user information at $date";
            case 'password-recover': return "Password Recovered at $date";
            // Deactivation
            case 'deactivation': return "Deactivated account at $date";
            case 'deactivation-admin': return "Deactivated user account at $date, account name: ";
            // Miscellanous
            case 'report-generate': return "Generated a report at $date";
            // Habit Board
            case 'board-create': return "Created a board at $date";
            case 'board-rename': return "Rename a board at $date";
            case 'board-delete': return "Deleted a board at $date";
            // Habit
            case 'habit-create': return "Created a habit at $date";
            case 'habit-delete': return "Delete a habit at $date";
        }
    }
?>