<?php
    require '../php/db.php';
    include "../php.utils/activity-logging.php";
    global $conn;

    $id = $_POST['id'];
    $query = "UPDATE users SET deleted_at = CURRENT_DATE WHERE id = $id";
    $executedQuery = mysqli_query($conn, $query);

    $curID = $_SESSION['currentUserID'];
    LogActivity_Deactivation($curID);
?>