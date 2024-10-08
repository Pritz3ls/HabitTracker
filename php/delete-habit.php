<?php
    if(isset($_POST['delete_habit'])){
        // Create a deletion query using the habit_id
        $habit_id = $_POST['habit_id'];
        $delete_query = "UPDATE habits 
        SET deleted_at = CURRENT_TIMESTAMP
        WHERE id = {$habit_id}";
        $delete = mysqli_query($conn, $delete_query);
    
        // Check if the executed query is successful
        if(!$delete){
            echo "Something went wrong!" . mysqli_connect_error($conn);
            return;
        }
    }
?>