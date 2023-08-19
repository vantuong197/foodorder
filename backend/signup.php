<?php
include('../config/constants.php')
?>
<html>

<head>
    <title>Signup Page</title>
    <link rel="stylesheet" href="../frontend/css/backend.css">
</head>

<body>

    <div class="main-content">
        <div class="wrapper">
            <h1>Start admin with us</h1>
            <br>
            <br>
            <?php
            if (isset($_SESSION['userexist'])) {
                echo $_SESSION['userexist'];
                unset($_SESSION['userexist']);
            }
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="fullname" placeholder="Enter your name" value="<?php echo (isset($_SESSION['userexist'])) ? $full_name : "" ?>"></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Enter your username" value="<?php echo (isset($_SESSION['userexist'])) ? $username : "" ?>"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="pdw" placeholder="Enter your password" value="<?php echo (isset($_SESSION['userexist'])) ? $password : "" ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Create Admin Account" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            
        </div>
    </div>
</body>

</html>


<?php
// Process the value from the form and save it in database
// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Get data from the form
    $full_name = $_POST['fullname'];
    $username = $_POST['username'];
    $password = md5($_POST['pdw']);
    // Check whether username is exist?
    $sqlSelect = "SELECT * FROM tbl_admin where username='$username'";
    $respon = mysqli_query($conn, $sqlSelect);
    if (mysqli_num_rows($respon) > 0) {
        $_SESSION['userexist'] = "Username already exists, Please choose another username";
        header('location:' . SITEURL . 'signup.php');
    } else {
        // SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET 
        full_name='$full_name',
        username='$username',
        password='$password'
        ";
        $res = mysqli_query($conn, $sql);
        // Check whether data is inserted or not
        if ($res == true) {
            // data inserted
            // Create a session variable to display message
            $_SESSION['add'] = "admin added successfully, Please Login";
            header("location:" . SITEURL . 'login.php');
        } 
    }
}