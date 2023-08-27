<?php 
    include('../frontend/components/header.php');
?>  

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Food</legend>
                    <?php 
                        if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM tbl_food WHERE id='$id'";
                            $res = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($res) > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    ?>
                                        <div class="food-menu-img">
                                            <img src="images/foods/<?php echo $row['image_name'] ?>" alt="" class="img-responsive img-curve">
                                            </div>
                                            <div class="food-menu-desc">
                                            <h3><?php echo $row['title'] ?></h3>
                                            <p class="food-price">$<?php echo $row['price'] ?></p>
                                            <div class="order-label">Quantity</div>
                                            <input type="number" name="qty" class="input-responsive" value="1" required>
                                        </div>
                                    <?php
                                }
                            }else{
                                
                            }
                        }else{

                        }
                    ?>    


                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Yamada" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 090-xxx-xxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. abc@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php 
    include('../frontend/components/footer.php');
?>  