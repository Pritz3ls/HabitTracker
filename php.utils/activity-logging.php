<?php
    function LogActivity_Login($id){
        global $conn;
        $message = GenerateActivityMessage('signin');

        $query = "INSERT INTO activity_logs(user_id, operation) VALUES($id, '$message')";
        $executedQuery = mysqli_query($conn, $query);
    }

    function GenerateActivityMessage($type){
        date_default_timezone_set("Asia/Manila");
        $date = date("h:i:s A");
        switch ($type){
            case 'signin': return "User signed in at $date";
            case 'forgot': return "User changed password at $date";
        }
    }
?>