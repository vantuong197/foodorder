<?php 
    include('../frontend/components/header.php');
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



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
                $sqlFood = "SELECT * FROM tbl_food WHERE active = 'yes'";
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

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php 
    include('../frontend/components/footer.php');
?>  