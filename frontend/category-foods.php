<?php 
    include('../frontend/components/header.php');
?>  

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"Category"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
                if(isset($_GET['q'])){
                    $id = $_GET['q'];
                    $sql = "SELECT * FROM tbl_food WHERE category_id='$id'";
                    $res = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            ?>
                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <img src="images/foods/<?php echo  $row['image_name']?>" alt="<?php echo  $row['title']?>" class="img-responsive img-curve">
                                    </div>

                                    <div class="food-menu-desc">
                                        <h4><?php echo  $row['title']?></h4>
                                        <p class="food-price">$<?php echo  $row['price']?></p>
                                        <p class="food-detail">
                                            <?php echo  $row['description']?>
                                        </p>
                                        <br>
                                        <a href="order.php?id=<?php echo  $row['id']?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>
                            <?php
                        }
                    }else{
                        $_SESSION['error'] = "";
                    header('location:' . SITEURLFRONT .'categories.php');
                    }
                }else{
                    header('location:' . SITEURLFRONT .'categories.php');
                }
               
            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php 
    include('../frontend/components/footer.php');
?>  