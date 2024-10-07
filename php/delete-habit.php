<?php
    // Create a deletion query using the habit_id
    $delete_query = "DELETE FROM habits WHERE habit_id = {habit_id}";
    $delete = mysqli_query($conn, $delete_query);

    // Check if the executed query is successful
    if(!$user){
        echo "Something went wrong!" . mysqli_connect_error($conn);
        return;
    }
?>