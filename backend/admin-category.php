<?php
include("./components/header.php")
?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br />
        <br />

        <a href="./add-category.php" class="btn-primary">Add Category</a>
        <br />
        <br />
        <?php
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        ?>
        <br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);
            $sn = 1;
            if (mysqli_num_rows($res) > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++ ?>.</td>
                        <td><?php echo $title ?></td>
                        <td>
                            <img src="<?php echo "../frontend/images/categorys/" . $image_name ?>" width="100px">

                        </td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="<?php echo SITEURL . "update-category.php?id=" . $id . "&title=" . $title . "&image=" . $image_name . "&featured=" . $featured . "&active=" . $active ?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL . "delete-category.php?id=" . $id . "&image=" . $image_name ?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td class="error">No category added</td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section end -->
<?php
include("./components/footer.php")
?>