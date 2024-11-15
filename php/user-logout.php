<?php
    // Handles logout for the website
    // This checks if the user chose to logout
    if(array_key_exists('logout', $_POST)){
        user_logout();
        return;
    }
    
    // Call the logout function
    user_logout();
    function user_logout(){
        session_start();
        session_destroy();
        Header("Location: ../index.php");
    }
?>