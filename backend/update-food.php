<?php 
    include('../backend/components/header.php')
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>New Title:</td>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td>New Description:</td>
                    <td><textarea name="desc" id="" cols="30" rows="2" placeholder="Description of the food"></textarea></td>
                </tr>
                <tr>
                    <td>New Price:</td>
                    <td><input type="number" name="price"></td>
                </tr> 
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>  
                <tr>
                    <td>New Category:</td>
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
                    <td colspan="2"><input type="submit" value="Add Food" class="btn-secondary" name="submit"></td>
                </tr> 
            </table>
        </form>
    </div>
</div>
