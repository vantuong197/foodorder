<?php 
    include('../config/constants.php');
    //1. Destroy the Session
    session_destroy();
    // 2. Redirect to Login page
    header('location:'.SITEURL.'login.php');
