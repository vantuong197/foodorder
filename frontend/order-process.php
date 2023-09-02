<?php 
    include('../config/constants.php');
?>
<?php 
    if(isset($_POST['data'])){
        $data = $_POST['data'];
        $foods = [];
        for($x = 0; $x < count($data['listFood']); $x++){
            $food['id'] =  $data['listFood'][$x]['id'];
            $food['qty'] =  $data['listFood'][$x]['qty'];
            $foods[] = $food;
        }
        $foods_string = serialize($foods); 
        // $unserialized_array = unserialize($serialized_array); 

        // var_dump($foods_string); // gives back a string, perfectly for db saving!
        // var_dump($unserialized_array); // gives back the array again
        $fullname = $data['userInfor'][0]['fullname'];
        $contact = $data['userInfor'][0]['contact'];
        $email = $data['userInfor'][0]['email'];
        $address = $data['userInfor'][0]['address'];
        $orderTime = date("Y-m-d h:i:s");
        $sql = "INSERT INTO tbl_order (food,order_date, customer_name, customer_contact, customer_email, customer_address)
            VALUES ('$foods_string','$orderTime','$fullname','$contact','$email', '$address')
        ";
        if (mysqli_query($conn, $sql)) {
            setcookie($cookie_name, $cookie_value, time() - 3600, '/');
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>