<?php
        // Start session
        session_start();
        // Execute Query and save data in database
        define('SITEURL', 'http://localhost/foodorder/backend/');
        define('SITEURLFRONT', 'http://localhost/foodorder/frontend/');
        define('LOCALHOST', 'localhost');
        define('DB_USERNAME', 'root');
        define('PASSWORD', '');
        define('TABLE_ORDER', 'food-order');
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, PASSWORD, TABLE_ORDER) or die(mysqli_error($conn));
?>