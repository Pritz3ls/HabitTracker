<?php
    $num_pages = 0;
    $rows_per_page = 15;
    $start = 0;

    // Handles Inputs
    if(isset($_POST['reset'])){
        // Search name
        unset($_SESSION['mis_act_date_max']);
        unset($_SESSION['mis_act_date_min']);
        // Sort by
        unset($_SESSION['mis_act_sortby']);
        unset($_SESSION['mis_act_categoryby']);
    }
    if(isset($_POST['filter'])){
        // Search Exact Date
        $_SESSION['mis_act_date_min'] = $_POST['date_min'];
        $_SESSION['mis_act_date_max'] = $_POST['date_max'];
        // Sort by
        $_SESSION['mis_act_sortby'] = $_POST['sortBy'];
        // Category
        $_SESSION['mis_act_categoryby'] = $_POST['categoryBy'];
        RefreshPage();
    }
    
    // Refresh MIS Page
    function RefreshPage(){
        Header("Location: manage-activity.php");
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
        
        if(mysqli_num_rows($executed_record_query) <= 0){
            ?><tr>  
                    <td colspan="6" style="text-align:center">No Records</td>
            </tr><?php
            return;
        }

        $executed_table_query = mysqli_query($conn, GetQuery(true));
        while ($data = mysqli_fetch_assoc($executed_table_query)){
            $id = $data['activity_log_id'];
            $user_id = $data['user_id'];
            $admin_name = $data['admin_name'];
            $user_type = $data['user_type'];
            $operation = $data['operation'];
            $log_date = $data['log_date'];

            echo '<tr>';
                echo "<td width='2%'>{$id}</td>";
                echo "<td width='2%'>{$user_id}</td>";
                echo "<td width='6%'>".ucfirst($user_type)."</td>";
                echo "<td width='10%'>{$admin_name}</td>";
                echo "<td width='60%'>{$operation}</td>";
                echo "<td width='15%'>{$log_date}</td>";
            echo '</tr>';
        }
    }

    // Pagination
    if(isset($_GET['page-nr'])){
        $page = $_GET['page-nr']-1;
        $start = $page * $rows_per_page;
    }

    // Get Query with filter if included
    function GetQuery($limit = false){
        global $rows_per_page;
        global $start;

        $query = "SELECT activity_log_id, user_id, operation, 
            log_date, users.user_name as admin_name, users.user_type as user_type
            FROM activity_logs
            INNER JOIN users ON activity_logs.user_id = users.id ";
        // Filter date
        if(!empty($_SESSION['mis_act_date_min'])){
            $min = $_SESSION['mis_act_date_min'];
            // If theres also a max date range, include it
            if(!empty($_SESSION['mis_act_date_max'])){
                $max = $_SESSION['mis_act_date_max'];

                $query = $query."WHERE DATE(log_date) BETWEEN '$min' AND '$max'";
            }else{
                // Else, just the minimum
                $query = $query."WHERE DATE(log_date) = '$min'";
            }
            if(!empty($_SESSION['mis_act_categoryby'])){
                $category = $_SESSION['mis_act_categoryby'];
                $query = $query." AND operation LIKE '%$category%'";
            }
        }else{
            if(!empty($_SESSION['mis_act_categoryby'])){
                $category = $_SESSION['mis_act_categoryby'];
                $query = $query." WHERE operation LIKE '%$category%'";
            }
        }
        // Filter sorty by
        if(!empty($_SESSION['mis_act_sortby'])){
            $order = $_SESSION['mis_act_sortby'] == "log_date" ? 'DESC' : 'ASC';
            $query = $query." ORDER BY {$_SESSION['mis_act_sortby']} {$order}";
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
