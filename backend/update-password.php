<?php
include("../backend/components/header.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="currentpwd" placeholder="Enter your current password""></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="newpwd" placeholder="Enter your new password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirmpwd" placeholder="Confirm password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        <input type="hidden" name="id" value="<?php echo $id?>"class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>






<?php
include("../backend/components/footer.php");

?>