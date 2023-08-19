<?php
include('../backend/components/header.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
            if(isset($_SESSION['addsuccess'])){
                echo $_SESSION['addsuccess'];
                unset($_SESSION['addsuccess']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['fileinvalid'])){
                echo $_SESSION['fileinvalid'];
                unset($_SESSION['fileinvalid']);
            }
        ?>
        <!-- Add category form start -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>
                <tr>
                    <td>Select image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Feature:</td>
                    <td>
                        <input type="radio" name="featured" value="yes"> Yes
                        <input type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes"> Yes
                        <input type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form end -->

        <?php
        if (isset($_POST['submit'])) {
            // 1. Get data from category form
            $title = $_POST['title'];
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }
            // Check whether the image is selected or not and set the value for image name
            if (isset($_FILES['image']['name'])) {
                // Upload the image
                $imageName = $_FILES['image']['name'];
                // Auto rename our image
                $ext = end(explode('.', $imageName));
                if($ext !== "jpg" || $ext !== "pgn" || $ext !== "gif"){
                    $_SESSION['fileinvalid'] = "<div class='error'>Choosen file is not a image</div>";
                    header('location:' . SITEURL . 'add-category.php');
                    die();
                }
                $sourcePath = $_FILES['image']['tmp_name'];
                $destinationPath = "../frontend/images/categorys/" . $imageName;
                // Upload the image
                $upload = move_uploaded_file($sourcePath, $destinationPath);

                // Check whether the image is uploaded or not
                if ($upload === false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                    header('location:' . SITEURL . 'add-category.php');
                    die();
                }
            } else {
                // Will not update image and set the image_name value as blank
                $imageName = "";
            }
            $sqlInsert = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$imageName',
                    featured='$featured',
                    active='$active'
                ";

            // Execute the query to save data in database
            $res = mysqli_query($conn, $sqlInsert);

            // Check whether the data is saved or not
            if ($res === true) {
                // data is inserted
                $_SESSION['addsuccess'] = "<div class='success'>Category added successfully.</div>";
                header('location:' . SITEURL . 'add-category.php');
            } else {
                // insert data failed
                $_SESSION['addsuccess'] = "<div class='error'>Failed to add category</div>";
                header('location:' . SITEURL . 'add-category.php');
            }
        }
        ?>
    </div>
</div>


<?php
include('../backend/components/footer.php');
?>