<?php  
    // Replace this with the current ID
    global $curID;
    $curID = $_SESSION['currentUserID'];

    function Fetch_Username(){
        global $conn;
        global $curID;
        $query = "SELECT user_name FROM users WHERE id = $curID";
        $executedQuery = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executedQuery);
        return $data['user_name'];
    }
    function Fetch_Password(){
        global $conn;
        global $curID;
        $query = "SELECT password FROM users WHERE id = $curID";
        $executedQuery = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executedQuery);
        return $data['password'];
    }
    function Fetch_Preferences(){
        global $conn;
        global $curID;
        $query = "SELECT board_name FROM habit_board WHERE user_id = $curID";
        $executedQuery = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($executedQuery)){
            ?>
                <div>
                    <label for="<?php echo $row['board_name']?>"><?php echo $row['board_name']?></label>
                    <input type="checkbox" name="<?php echo $row['board_name']?>" checked>
                </div>
            <?php
        }
    }
?>