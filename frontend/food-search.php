<?php 
    include('../frontend/components/header.php');
?>  
<?php
    if(isset($_POST['submit'])){
        $searchKey = $_POST['search'];
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$searchKey%'";
        $res = mysqli_query($conn, $sql);
    }  
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $searchKey ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
                if(mysqli_num_rows($res) > 0){
                    while($row = mysqli_fetch_assoc($res)){
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