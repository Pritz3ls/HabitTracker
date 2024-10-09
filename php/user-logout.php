<?php
    if(array_key_exists('logout', $_POST)){
        user_logout();
    }
    
    function user_logout(){
        session_start();
        session_destroy();
        Header("Location: testLanding.php");
    }
?>