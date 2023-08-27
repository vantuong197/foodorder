<?php 
    include('../frontend/components/header.php');
?>  
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                $sqlSelect = "SELECT * FROM tbl_category where active = 'yes'";
                $res = mysqli_query($conn, $sqlSelect);
                if(mysqli_num_rows($res) > 0)
                {
                     while($row = mysqli_fetch_assoc($res))
                     {
                        ?>
                            <a href="category-foods.php?q=<?php echo $row['id'] ?>">
                            <div class="box-3 float-container">
                                <img src="images/categorys/<?php echo $row['image_name'] ?>" alt="<?php echo $row['title'] ?>" class="img-responsive img-curve">
                                <h3 class="float-text text-white"><?php echo $row['title'] ?></h3>
                            </div>
                            </a>
                        <?php
                     }
                }else
                {

                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php 
    include('../frontend/components/footer.php');
?>  