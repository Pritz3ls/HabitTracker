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
    function Fetch_ReportsPreferences(){
        global $conn;
        global $curID;
        $query = "SELECT board_name FROM habit_board WHERE user_id = $curID AND deleted_at IS NULL";
        $executedQuery = mysqli_query($conn, $query);

        // There are no boards
        if(mysqli_num_rows($executedQuery) <= 0){
            ?>
                <div class="no-item">
                    <p>You dont have any habit boards.</p>
                </div>
            <?php
            return;
        }
        while ($row = mysqli_fetch_assoc($executedQuery)){
            ?>
                <div class="preference">
                    <input type="checkbox" name="<?php echo $row['board_name']?>" checked>
                    <label for="<?php echo $row['board_name']?>"><?php echo $row['board_name']?></label>
                </div>
            <?php
        }
    }
    function Fetch_2FA(){
        global $conn;
        global $curID;
        $query = "SELECT prefer_2FA FROM users WHERE id = $curID";
        $executedQuery = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executedQuery);
        return $data['prefer_2FA'];
    }
?>