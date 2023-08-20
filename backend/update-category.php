<?php 
    include('../backend/components/header.php')
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br>
        <br>
        <?php 
            if(isset($_SESSION['fileinvalid'])){
                echo $_SESSION['fileinvalid'];
                unset($_SESSION['fileinvalid']);
            }
        ?>
        <?php 
            $id = $_GET['id'];
            $title = $_GET['title'];
            $image = $_GET['image'];
            $featured = $_GET['featured'];
            $active = $_GET['active'];
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Enter your name" value="<?php echo$title?>"></td>
                </tr>
                <tr>
                    <td>New image:</td>
                    <td>
                        <input type="file" name="image">
                        <input type="hidden" name='curImage' value="<?php echo $image?>">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <?php 
                            if($featured === "yes"){
                                ?>
                                <input type="radio" name="featured" value="yes" checked> Yes
                                <input type="radio" name="featured" value="no"> No
                                <?php     
                            }else{
                                ?>
                                <input type="radio" name="featured" value="yes"> Yes
                                <input type="radio" name="featured" value="no" checked> No
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                    <?php 
                            if($active === "yes"){
                                ?>
                                <input type="radio" name="active" value="yes" checked> Yes
                                <input type="radio" name="active" value="no"> No
                                <?php     
                            }else{
                                ?>
                                <input type="radio" name="active" value="yes"> Yes
                                <input type="radio" name="active" value="no" checked> No
                                <?php
                            }
                        ?>
                    </td>
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
        $newTitle = $_POST['title'];
        $curImage = $_POST['curImage'];
        $newImg = "";
        $newFeatured = $_POST['featured'];
        $newActive = $_POST['active'];
        $updateImg = false;
        if(!empty($_FILES['image']['name'])){
            $newImg = $_FILES['image']['name'];
            $ext = end(explode('.', $newImg));
            if($ext === "jpg" || $ext === "pgn" || $ext === "gif"){
                $newImg = "Food_category_".rand(000,999).rand(000,999).".".$ext;
                $sourcePath = $_FILES['image']['tmp_name'];
                $destinationPath = "../frontend/images/categorys/" . $newImg;
                $oldDesPath = "../frontend/images/categorys/" . $curImage;
                $updateImg = true;
            }else{
                // echo $ext;
                $_SESSION['fileinvalid'] = "<div class='error'>Choosen file is not a image</div>";
                header('location:' . SITEURL . 'update-category.php?id='.$id.'&title='.$newTitle.'&image='.$$curImage.'&featured='.$newFeatured.'&active='.$newActive);
                die();
            }
        }else{
            $newImg = $curImage;
        }
        $sqlUpdate = "UPDATE tbl_category SET
            title='$newTitle',
            image_name='$newImg',
            featured='$newFeatured',
            active='$newActive'
            WHERE id=$id
        ";
        if(mysqli_query($conn, $sqlUpdate)){
            $_SESSION['update'] = '<div class="success">The category has been updated</div>';
            if($updateImg){
                if (file_exists($oldDesPath)) {
                    // Attempt to delete the file
                    unlink($oldDesPath);
                } 
                move_uploaded_file($sourcePath, $destinationPath);
            }
            header('location:'.SITEURL.'admin-category.php');
        }
    }
?>
<?php 
    include('../backend/components/footer.php')
?>