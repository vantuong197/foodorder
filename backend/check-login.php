<?php 
    if(!isset($_SESSION['user'])){
        $_SESSION['login'] = 'Not logged in yet';
        header('location:'.SITEURL.'login.php');
    }
?>