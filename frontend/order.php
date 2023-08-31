<?php 
    include('../frontend/components/header.php');
?>  

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order" method="POST" id="formOrder" onsubmit="sendDataToServer(event)">
                <fieldset>
                    <legend>Selected Food</legend>
                    <?php 
                        // Retrieve the existing cart data from the cookie
                        $cartData = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : [];
                        if(strlen($cartData) > 2){
                            $listItem = [];
                            $cart = json_decode($cartData, true);
                            $cartId = implode(',', $cart);
                            $sql = "SELECT * FROM tbl_food WHERE id in ({$cartId})";
                            $res = mysqli_query($conn, $sql);
                        // Before
                            if(mysqli_num_rows($res) > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $listItem[] = $row['id'];
                                    ?>
                                        <div class="food-menu-img">
                                                <img src="images/foods/<?php echo $row['image_name'] ?>" alt="" class="img-responsive img-curve">
                                        </div>
                                        <div class="food-menu-desc">
                                            <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                            <h3><?php echo $row['title'] ?></h3>
                                            <p class="food-price">$<?php echo $row['price'] ?></p>
                                            <div class="order-label">Quantity</div>
                                            <input type="number" name="qty" class="input-responsive" required>
                                            <div class="delete"><a class="btn btn-danger" onclick="removeToCart(<?php echo $row['id'] ?>)">X</a></div>
                                        </div>      
                                    <?php
                                }
                            }else{
                                ?>
                                <h3>No food added</h3>
                                <?php 
                            }
                        }else{
                            ?>
                                <h3>No food added</h3>
                                <?php 
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
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary" >
                </fieldset>
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<?php 
    include('../frontend/components/footer.php');
?>  