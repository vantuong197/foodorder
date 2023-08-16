<?php
include("./components/header.php")
?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Admin</h1>
        <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <br />
        <br />
        <a href="add-admin.php" class="btn-primary">Add admin</a>
        <br />
        <br />
        <br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            // Query to get all admin
            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);
            $sn = 1;
            //  Check whether the query is success or not
            //count rows to check whether we have data or not
            if (mysqli_num_rows($res) > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $fullname = $rows['full_name'];
                    $username = $rows['username'];
            ?>
                    <tr>
                        <td><?php echo $sn++ . "."; ?></td>
                        <td><?php echo $fullname; ?></td>
                        <td>v<?php echo $username; ?></td>
                        <td>
                            <a href="" class="btn-secondary">Update Admin</a>
                            <a href="" class="btn-danger">Delete</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section end -->
<?php
include("./components/footer.php")
?>