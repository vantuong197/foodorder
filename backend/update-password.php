<?php
include("../backend/components/header.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) === 0) {
                $_SESSION['userinvalid'] = "This user doesn't exist";
                header('location:' . SITEURL . 'admin.php');
            }
        }
        ?>
        <?php
        if (isset($_POST['submit'])) {
            $currentPwd = $_POST['currentpwd'];
            $id = $_POST['id'];
            $newPwd = $_POST['newpwd'];
            $confirmPwd = $_POST['confirmpwd'];
            if (strlen($currentPwd) === 0) {
                echo 'Please enter your current password';
            }elseif(strlen($newPwd) === 0){
                echo 'Please enter your new password';
            }elseif(strlen($confirmPwd) === 0){
                echo 'Please enter your confirm password';
            }elseif($newPwd !== $confirmPwd){
                echo 'Your password and confirmation password do not match';
            }else{
                $md5pwd = md5($currentPwd);
                $sqlSelect = "SELECT * FROM tbl_admin WHERE id=$id AND password='$md5pwd'";
                $resSelect = mysqli_query($conn, $sqlSelect);
                if(mysqli_num_rows($resSelect) === 0){
                    echo "Current password is invalid, please enter valid password";
                }else{
                    $md5newPwd = md5($newPwd);
                    $sqlUpdate = "UPDATE tbl_admin SET
                    password='$md5newPwd'
                    where id=$id
                    ";
                    $resUpdate = mysqli_query($conn, $sqlUpdate);
                    if($resUpdate === true){
                        $_SESSION['update-success'] = 'Password are updated';
                        header('location:'.SITEURL.'admin.php');
                    }
                }
            }

        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="currentpwd" placeholder="Enter your current password" value="<?php echo (isset($_POST['submit'])) ? $currentPwd : ""?>"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="newpwd" placeholder="Enter your new password" value="<?php echo (isset($_POST['submit'])) ? $newPwd : ""?>"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirmpwd" placeholder="Confirm password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        <input type="hidden" name="id" value="<?php echo $id ?>" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
include("../backend/components/footer.php");

?>