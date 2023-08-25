<?php
include("../backend/components/header.php");
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
        <br>

        <?php 
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) > 0){
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $userName = $row['username'];
            }else{
                header('location:'.SITEURL.'admin.php');
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="fullname" placeholder="Enter your name" value="<?php echo$full_name?>"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your username" value="<?php echo$userName?>"></td>
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
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $full_name = $_POST['fullname'];
        $userName = $_POST['username'];
        $sql = "UPDATE tbl_admin set
            full_name = '$full_name',
            username = '$userName'
        where id = '$id'
        ";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['update'] = "Record updated successfully";
            header('location:'.SITEURL.'admin.php');
        } else {
            $_SESSION['update'] = "Error updating record: " . mysqli_error($conn);
            header('location:'.SITEURL.'admin.php');
        }
        
    }

?>




<?php
include("../backend/components/footer.php");
?>