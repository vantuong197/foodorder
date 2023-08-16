<?php
include("./components/header.php")
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br>
        <br>
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="fullname" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="pdw" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php
include("./components/footer.php")
?>

<?php
// Process the value from the form and save it in database
// Check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        // Get data from the form
        $full_name = $_POST['fullname'];
        $username = $_POST['username'];
        $password = md5($_POST['pdw']);

        // SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        $res = mysqli_query($conn, $sql);

        // Check whether data is inserted or not

        if($res == true){
            // data inserted
            // Create a session variable to display message
            $_SESSION['add'] = "admin added successfully";
            header("location:".SITEURL.'admin.php');
        }else{
            // Create a session variable to display message
            $_SESSION['add'] = "admin added failed";
            header("location:".SITEURL.'add-admin.php');
        }


    }else{

    }
