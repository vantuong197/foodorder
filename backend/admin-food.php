<?php
include("./components/header.php")
?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br />
        <br />

        <a href="<?php echo SITEURL.'add-food.php'?>" class="btn-primary">Add food</a>
        <br />
        <br />
        <br />
        <?php 
            if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
            if(isset( $_SESSION['update'])){
                echo  $_SESSION['update'];
                unset( $_SESSION['update']);
            }
           
        ?>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php 
                $sn = 1;
                $sqlSelect = "SELECT * FROM tbl_food";
                $res = mysqli_query($conn, $sqlSelect);
                if(mysqli_num_rows($res)>0){
                    while($row = mysqli_fetch_assoc($res)){
                        ?>
                            <tr>
                                <td><?php echo $sn++?></td>
                                <td><?php echo $row['title']?></td>
                                <td><?php echo $row['description']?></td>
                                <td><?php echo $row['price']?></td>
                                <td><img src="<?php echo "../frontend/images/foods/" . $row['image_name'] ?>" alt="" width="100px" height="auto" ></td>
                                <td><?php echo $row['featured']?></td>
                                <td><?php echo $row['active']?></td>
                                <td>
                                    <a href="<?php echo SITEURL . "update-food.php?id=" . $row['id']?>" class="btn-secondary">Update Food</a>
                                    <a href="" class="btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php
                    }
                }else{
                    echo '<tr> <td colspan="7" class="error">Food not Added yet. </td></tr>';
                }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section end -->
<?php
include("./components/footer.php")
?>