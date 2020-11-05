<?php 

    session_start();

    $_SESSION['email']='';
    
    if($_SESSION['email']==''){
        header("Location: login.php?alert=logout");
    }

?>