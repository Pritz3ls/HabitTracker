<?php
    session_start();
    // Redirect user to login page if the current session ID is empty or null
    if(empty($_SESSION['currentUserID'])){
        Header("Location: testLogin.php");
        exit;
    }

    // Check what button are picked or clicked
    if(isset($_POST['delete'])){
        DELETE($_POST['selected-userID']);
    }
    
    // Delete function
    function DELETE($userID){
        $delete_query = "UPDATE users SET deleted_at = CURRENT_DATE WHERE id = {$userID}";
        $delete = mysqli_query($conn, $delete_query);

        $operation_message = LOG_ACTIVITY(1, $userID);
        $admin_id = $_SESSION['currentUserID'];

        $log_query = "INSERT INTO activity_logs(admin_id, operation, log_date)
        VALUES({$admin_id}, '{$operation_message}', CURRENT_TIMESTAMP)";
    }

    function LOG_ACTIVITY($index, $userID){
        return $index == 1 ? "Deleted user at index: ".$userID : "Edited user at index: ".$userID;
    }
?>