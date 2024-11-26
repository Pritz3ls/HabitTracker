<?php
    include '../php/db.php';
    $curID = $_SESSION['currentUserID'];
    $query = "
        SELECT 
            COUNT(habits.id) AS completed_habits,
            DATE_FORMAT(habit_logs.created_at, '%b %d %Y') as date
        FROM users
        JOIN habit_board ON users.id = habit_board.user_id
        JOIN habits ON habit_board.id = habits.board_id
        JOIN habit_logs ON habits.id = habit_logs.habit_id
        AND users.id = $curID
        GROUP BY date ASC
        LIMIT 7
    ";
    $executed_query = mysqli_query($conn, $query);
    $data = [];
    while($row = mysqli_fetch_assoc($executed_query)){
        array_push($data, $row);
    }
    echo json_encode($data);
?>