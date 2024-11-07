<?php 
    // Specify the connection
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "habit-db";

    // Start a connection
    $conn = mysqli_connect($host, $user, $pass, $database);

    // Check if the connection is a success
    if(!$conn){
        die("Error, connection failed with {$database}". mysqli_connect_error());
    }
    session_start();
?>