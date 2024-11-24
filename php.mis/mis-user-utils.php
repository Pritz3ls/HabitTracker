<?php
    $num_pages = 0;
    $rows_per_page = 10;
    $start = 0;

    // Handles Inputs
    if(isset($_POST['reset'])){
        // Search name
        unset($_SESSION['mis_user_name']);
        // Sort by
        unset($_SESSION['mis_user_sortby']);
    }
    if(isset($_POST['filter'])){
        // Search Name
        $_SESSION['mis_user_name'] = $_POST['username'];
        // Sort by
        $_SESSION['mis_user_sortby'] = $_POST['sortBy'];
        RefreshPage();
    }
    if(isset($_POST['save-account'])){
        SaveEditInformation($_POST['view_user_id']);
    }
    if(isset($_POST['delete-account'])){
        SaveEditInformation($_POST['view_user_id']);
    }
    
    // Refresh MIS Page
    function RefreshPage(){
        Header("Location: manage-users.php");
    }

    // Manage Users
    // Fetch table data
    function FetchTableData(){
        global $conn;
        global $num_pages;
        global $rows_per_page;
        global $start;

        $executed_record_query = mysqli_query($conn, GetQuery());
        if(!$executed_record_query){
            echo "Error";
            return;
        }
        $records = mysqli_num_rows($executed_record_query);
        $num_pages = ceil($records / $rows_per_page);
        
        $executed_table_query = mysqli_query($conn, GetQuery(true));
        while ($data = mysqli_fetch_assoc($executed_table_query)){
            $id = $data['id'];
            $type = $data['user_type'];
            $name = $data['user_name'];
            $phone = $data['phone_number'];
            $date = $data['created_at'];

            echo '<tr>';
                echo "<td>{$id}</td>";
                echo "<td>{$type}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$phone}</td>";
                echo "<td>{$date}</td>";
                ?>
                    <td><button type='button' onClick="ConfirmDeactivation(<?php echo $id?>)">Deactivate</button></td>
                <?php
            echo '</tr>';
        }
    }
    // Edit User
    // Save edited information
    function SaveEditInformation($id){
        global $conn;

        // Build the query on what input fields are used
        $query = "UPDATE users SET ";
        $operation_message = "Edited user at index $id,\n";
        $old_info = GetUserBasicInformation($id);

        // Tracks how many columns to be updated
        // Separator on columns
        $updates = 0;

        if(!empty($_POST['username'])){
            $new_name = $_POST['username'];
            $query = $query."user_name = '$new_name'";
            $updates++;

            // Updates operation message
            $operation_message = $operation_message."changed user name {$old_info['name']} to $new_name";
        }
        if(!empty($_POST['phone_number'])){
            if($updates >= 1){
                $query = $query.',';
                $operation_message = $operation_message.', ';
            }
            $new_phone = $_POST['phone_number'];
            $query = $query."phone_number = '$new_phone'";
            $updates++;

            // Validation first
            if(!ValidatePhoneNumberUsed($id, $new_phone)){return;}

            // Updates operation message
            $operation_message = $operation_message."changed phone number {$old_info['phone']} to $new_phone";
        }
        if(!empty($_POST['password'])){
            if($updates >= 1){
                $query = $query.',';
                $operation_message = $operation_message.', ';
            }

            $new_pass = $_POST['password'];
            $query = $query."password = '$new_pass'";

            // Updates operation message
            $operation_message = $operation_message."changed password {$old_info['pass']} to $new_pass";
        }
        $query = $query." WHERE id = $id";
        // Execute the query
        $executedQuery = mysqli_query($conn, $query);
        if(!$executedQuery){
            return;
        }
        // Print out a indication
        echo "<script>alert('Update Succesful!')</script>";
    }

    // Updates Validation
    function ValidatePhoneNumberUsed($id, $phone){
        global $conn;
        $query = "SELECT id, user_name FROM users WHERE phone_number = '$phone' AND id != $id AND deleted_at IS NULL";
        $executedQuery = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executedQuery);
        if(mysqli_num_rows($executedQuery) == 1){
            $id = $data['id'];
            $name = $data['user_name'];
            echo "<script>alert('Phone number is already used by other user, ID: $id, Name: $name')</script>";
            return false;
        }
        return true;
    }
    function GetUserBasicInformation($id){
        global $conn;
        $query = "SELECT user_name, phone_number, password FROM users WHERE id = $id";
        $executedQuery = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executedQuery);

        $arr['name'] = $data['user_name'];
        $arr['phone'] = $data['phone_number'];
        $arr['pass'] = $data['password'];
        return $arr;
    }

    // Pagination
    if(isset($_GET['page-nr'])){
        $page = $_GET['page-nr']-1;
        $start = $page * $rows_per_page;
    }

    function GetQuery($limit = false){
        global $rows_per_page;
        global $start;

        $query = "SELECT * FROM users WHERE deleted_at IS NULL";

        // Filter name
        if(!empty($_SESSION['mis_user_name'])){
            $query = $query." AND user_name LIKE '%{$_SESSION['mis_user_name']}%'";
        }
        // Filter sorty by
        if(!empty($_SESSION['mis_user_sortby'])){
            $order = $_SESSION['mis_user_sortby'] == "user_name" ? 'ASC' : 'DESC';
            $query = $query." ORDER BY {$_SESSION['mis_user_sortby']} {$order}";
        }

        if($limit){
            $query = $query." LIMIT {$start}, {$rows_per_page}";
        }
        return $query;
    }
    // Template
    /*
        global $conn;
        $query = "";
        $executedQuery = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($executedQuery);
    */
?>
