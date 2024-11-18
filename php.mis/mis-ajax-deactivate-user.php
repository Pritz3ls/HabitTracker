<?php
    require '../php/db.php';
    include "../php.utils/activity-logging.php";
    global $conn;

    $id = $_POST['id'];
    $query = "UPDATE users SET deleted_at = CURRENT_DATE WHERE id = $id";
    $executedQuery = mysqli_query($conn, $query);

    $select = "SELECT user_name FROM users WHERE id = $id";
    $execSelect = mysqli_query($conn, $select);
    $data = mysqli_fetch_assoc($execSelect);
    $target = $data['user_name'];

    $curID = $_SESSION['currentUserID'];
    LogActivity_Deactivation_Admin($curID, $target);
?>