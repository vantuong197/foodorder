<?php include('../backend/components/header.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['fileinvalid'])){
                echo $_SESSION['fileinvalid'];
                unset($_SESSION['fileinvalid']);
            }
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="desc" id="" cols="30" rows="2" placeholder="Description of the food"></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
                </tr> 
                <tr>
                    <td>Selet Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>  
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php 
                                // Create query to display all active categories from database
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
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" checked>Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr> 
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" checked>Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr> 
                <tr>
                    <td colspan="2"><input type="submit" value="Add Food" class="btn-secondary" name="submit"></td>
                </tr> 
            </table>
        </form>

        <?php
            // Check whether the submit button is clicked or not
            if(isset($_POST['submit'])){
                // Get data from the form
                $title = $_POST['title'];
                $desc = $_POST['desc'];
                $price = $_POST['price'];
                $categoryId = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                // Check uploaded image and Upload the image to image folder
                if (!empty($_FILES['image']['name'])) {
                    // Upload the image
                    $imageName = $_FILES['image']['name'];
                    // Auto rename our image
                    $exp = explode('.', $imageName);
                    $ext = end($exp);
                    if($ext === "jpg" || $ext === "png" || $ext === "gif"){
                        $imageName = "Food_category_".rand(000,999).rand(000,999).".".$ext;
                    }else{
                        $_SESSION['fileinvalid'] = "<div class='error'>Choosen file is not a image</div>";
                        header('location:' . SITEURL . 'add-food.php');
                        die();
                    }
                    $sourcePath = $_FILES['image']['tmp_name'];
                    $destinationPath = "../frontend/images/foods/" . $imageName;
                    // Upload the image
                    $upload = move_uploaded_file($sourcePath, $destinationPath);
                    // Check whether the image is uploaded or not
                    if ($upload === false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        header('location:' . SITEURL . 'add-food.php');
                        die();
                    }
                } else {
                    // Will not update image and set the image_name value as blank
                    $_SESSION['fileinvalid'] = "<div class='error'>Please choose a image</div>";
                    header('location:' . SITEURL . 'add-food.php');
                    die();
                }
                // Insert data to database
                $sqlInsert = "INSERT INTO tbl_food SET
                    title='$title',
                    description='$desc',
                    price='$price',
                    image_name='$imageName',
                    category_id=$categoryId,
                    featured='$featured',
                    active='$active'
                ";
                if(mysqli_query($conn, $sqlInsert)){
                    // data is inserted
                    $_SESSION['add'] = "<div class='success'>Category added successfully.</div>";
                    header('location:' . SITEURL . 'add-food.php');
                }else{
                    unlink($destinationPath);
                    $_SESSION['add'] = "<div class='error'>Category failed to add.</div>";
                    header('location:' . SITEURL . 'add-food.php');
                    die();
                }   
            }
        ?>
    </div>
</div>

<?php include('../backend/components/footer.php')?>
