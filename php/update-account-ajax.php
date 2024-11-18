<?php
    include '../php/db.php';
    include "../php.utils/activity-logging.php";
    global $curID;
    $curID = $_SESSION['currentUserID'];
    
    if(isset($_POST['update_info'])){
        $name = $_POST['username'];
        $pass = $_POST['pass'];
        UpdateInformation($name, $pass);
    }
    function UpdateInformation($name, $pass){
        global $curID;
        global $conn;
        $query = "UPDATE users SET user_name = '$name', password = '$pass' WHERE id = $curID;";
        $executedQuery = mysqli_query($conn, $query);
        
        $curID = $_SESSION['currentUserID'];
        LogActivity_UpdateInformation($curID);
    }
?>