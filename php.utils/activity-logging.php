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

    function LogActivity_Deactivation($id){
        global $conn;
        $message = GenerateActivityMessage('deactivation');
        echo $message;
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

    function GenerateActivityMessage($type){
        date_default_timezone_set("Asia/Manila");
        $date = date("h:i:s A");
        switch ($type){
            case 'signin': return "User signed in at $date";
            case 'signout': return "User signed out at $date";
            case 'forgot': return "User changed password at $date";
            case 'update-info': return "Updated user information at $date";
            case 'deactivation': return "Deactivated account at $date";
        }
    }
?>