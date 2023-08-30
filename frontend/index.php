<?php 
    include('../frontend/components/header.php')
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
                $sqlCate = "SELECT * FROM tbl_category WHERE featured = 'yes' AND active = 'yes' LIMIT 3";
                $resCate = mysqli_query($conn, $sqlCate);
                if(mysqli_num_rows($resCate) > 0){
                    while($row = mysqli_fetch_assoc($resCate)){
                        ?>
                            <a href="category-foods.php?q=<?php echo $row['id'] ?>">
                            <div class="box-3 float-container">
                                <img src="images/categorys/<?php echo $row['image_name'] ?>" alt="<?php echo $row['title'] ?>" class="img-responsive img-curve">
                                <h3 class="float-text text-white"><?php echo $row['title'] ?></h3>
                            </div>
                            </a>
                        <?php
                    }
                }else{

                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center" id="foodmenu">Food Menu</h2>
            <?php 
                $sqlFood = "SELECT * FROM tbl_food WHERE featured = 'yes' AND active = 'yes' LIMIT 6";
                $resFood = mysqli_query($conn, $sqlFood);

                if(mysqli_num_rows($resFood) > 0){
                    while($row = mysqli_fetch_assoc($resFood)){
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <img src="images/foods/<?php echo $row['image_name'] ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $row['title'] ?></h4>
                                    <p class="food-price">$<?php echo $row['price'] ?></p>
                                    <p class="food-detail">
                                        <?php echo $row['description'] ?>
                                    </p>
                                    <br>
                                    <a href="order.php" class="btn btn-primary" onclick="addToCart(<?php echo $row['id'] ?>, true)">Order Now</a>
                                    <button class="btn-secondary btn" 
                                    onclick="addToCart(<?php echo $row['id'] ?>, false)">Add to cart</button>
                                </div>
                            </div>
                        <?php
                    }
                }else{
                    ?>
                        <p class="text-center">
                            Food No Found
                        </p>
                <?php
                }
            ?>
            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php 
    include('../frontend/components/footer.php');
?>    