<?php 
    include('../backend/components/header.php')
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <?php 
                if(empty($_GET['id'])){
                    $_SESSION['error'] = '<div class="error">Not found food</div>';
                    header('location:'.SITEURL.'admin-food.php');
                    
                }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <?php 
                    $id =  $_GET['id'];
                    $sql = "SELECT * FROM tbl_food where id=$id";
                    $res = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($res)>0){
                        while($row = mysqli_fetch_assoc($res)){
                            ?>
                                <tr>
                                    <td>New Title:</td>
                                    <td><input type="text" name="title" value="<?php echo $row['title']?>"></td>
                                </tr>
                                <tr>
                                    <td><input type="hidden" value="<?php echo $row['id']?>" name="id"></td>
                                </tr>
                                <tr>
                                    <td>New Description:</td>
                                    <td><textarea name="desc" id="" cols="30" rows="2" placeholder="Description of the food"> <?php echo $row['description']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>New Price:</td>
                                    <td><input type="number" name="price" value="<?php echo $row['price']?>"></td>
                                </tr> 
                                <tr>
                                    <td>Current Image:</td>
                                    <td><img src="<?php echo "../frontend/images/foods/".$row['image_name'] ?>" alt="" width="100px"></td>
                                    <input type="hidden" name='curImage' value="<?php echo $row['image_name']?>">
                                </tr>  
                            <?php
                        }
                    }else{
                        $_SESSION['error'] = '<div class="error">Not found food</div>';
                        header('location:'.SITEURL.'admin-food.php');
                    }
                ?>

                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="newImage"></td>
                </tr> 

                <tr>
                    <td>New Category:</td>
                    <td>
                        <select name="category">
                            <?php 
                                // Create query to display all active categories from dataFbase
                                $sqlCate = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sqlCate);
                                if(mysqli_num_rows($res) >0){
                                    while($rows = mysqli_fetch_assoc($res)){
                                        $id = $rows['id'];
                                        $title = $rows['title'];
                                        ?>
                                            <option value="<?php echo $id?>"><?php echo $title?></option>
                                        <?php
                                    }
                                }else{
                                    ?>
                                        <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>New Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" checked>Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr> 
                <tr>
                    <td>New Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" checked>Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr> 
                <tr>
                    <td colspan="2"><input type="submit" value="Update Food" class="btn-secondary" name="submit"></td>
                </tr> 
                
            </table>
        </form>
    </div>
</div>


<?php 
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        $curImage = $_POST['curImage'];
        $newImg = "";
        $updateImg = false;
        if(!empty($_FILES['newImage']['name'])){
            $newImg = $_FILES['newImage']['name'];
            $ext = end(explode('.', $newImg));
            if($ext === "jpg" || $ext === "pgn" || $ext === "gif"){
                $newImg = "Food_category_".rand(000,999).rand(000,999).".".$ext;
                $sourcePath = $_FILES['newImage']['tmp_name'];
                $destinationPath = "../frontend/images/foods/" . $newImg;
                $oldDesPath = "../frontend/images/foods/" . $curImage;
                $updateImg = true;
            }else{
                // echo $ext;
                $_SESSION['fileinvalid'] = "<div class='error'>Choosen file is not a image</div>";
                header('location:' . SITEURL . 'update-food.php?id='.$id);
                die();
            }
        }else{
            $newImg = $curImage;
        }

        $sqlUpdate = "UPDATE tbl_food SET
        title='$title',
        image_name='$newImg',
        featured='$featured',
        active='$active',
        description='$desc',
        price='$price',
        category_id=$category
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
            header('location:'.SITEURL.'admin-food.php');
        }
    }
?>