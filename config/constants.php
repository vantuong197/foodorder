<?php
        // Start session
        session_start();
        $cookie_name = "cart";
        $cookie_value = json_encode([]);
        if(!isset($_COOKIE[ $cookie_name])){
             setcookie($cookie_name, $cookie_value, time() + 3600, '/'); // 1 hour
        }
        // Execute Query and save data in database
        define('SITEURL', 'http://localhost/foodorder/backend/');
        define('SITEURLFRONT', 'http://localhost/foodorder/frontend/');
        define('LOCALHOST', 'localhost');
        define('DB_USERNAME', 'root');
        define('PASSWORD', '');
        define('TABLE_ORDER', 'food-order');
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, PASSWORD, TABLE_ORDER) or die(mysqli_error($conn));
?>