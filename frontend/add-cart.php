<?php 
    include('../config/constants.php');
?>
<?php 
    $cartData = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : '';
    $cart = !empty($cartData) ? json_decode($cartData, true) : [];
    if(isset($_POST['itemId'])){
        $id = $_POST['itemId'];
        $cart[] = $id;
        $cartData = json_encode($cart);
        setcookie($cookie_name, $cartData, time() + 3600, '/');
        $response = 'Item added to cart successfully';
        echo $response;
    }
?>