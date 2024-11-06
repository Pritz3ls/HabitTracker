<?php
    if(isset($_POST['create-board'])){
        // Fetch data
        $userId = $_SESSION['currentUserID'];
        $board_name = $_POST['board_name'];
        if(empty($board_name)){
            echo "<script>alert('Invalid inputs!')</script>";
            return;
        }

        $query = "INSERT INTO habit_board(board_name, user_id)
        VALUES('{$board_name}',$userId)";
        $executedQuery = mysqli_query($conn,$query);
        if(!$executedQuery){
            echo "Error!";
        }
    }
?>