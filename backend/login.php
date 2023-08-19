<?php
include('../config/constants.php')
?>
<html>

<head>
    <title>Login Page - Food Order System</title>
    <link rel="stylesheet" href="../frontend/css/backend.css">
</head>

<body>

    <div class="login">
        <h1 class="text-center">Login </h1><br><br>
        <?php
        if (isset($_SESSION['loginfail'])) {
            echo $_SESSION['loginfail'];
            unset($_SESSION['loginfail']);
        }
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="post" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter your username">
            <br><br>
            Password: <br>
            <input type="password" name="pwd" placeholder="Enter your passowrd">
            <br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
        </form><br><br>
        <p class="text-center">Do not have account? - <a href="./signup.php">Create acoount here</a></p>
        <p class="text-center">Created By - <a href="">Tuong Tran</a></p>
    </div>
</body>

</html>


<?php
//Check whether the submit btn is clicked or not
if (isset($_POST['submit'])) {
    //Process for Login

    // 1. Get data from login form
    $userName = $_POST['username'];
    $pwd = md5($_POST['pwd']);

    // 2. SQL query to check whether username and password exists or not
    $sqlSelect = "SELECT * FROM tbl_admin WHERE username='$userName' AND password='$pwd'";

    // 3. Execute the query
    $res = mysqli_query($conn, $sqlSelect);
    if (mysqli_num_rows($res) > 0) {
        $_SESSION['loginsuccess'] = "Login Seccessful";
        $_SESSION['user'] = $userName;
        header('location:' . SITEURL);
    } else {
        $_SESSION['loginfail'] = "Username or password is incorrect";
        header('location:' . SITEURL . 'login.php');
    }
}

?>