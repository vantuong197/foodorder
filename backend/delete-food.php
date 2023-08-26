<?php 
    include('../config/constants.php');
    include('./check-login.php');
?>

<?php   
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)){
            $destinationPath = "../frontend/images/foods/" . $row['image_name'];
            $sqlDel = "DELETE FROM tbl_food WHERE id=$id";
            if (mysqli_query($conn, $sqlDel)) {
                if (file_exists($destinationPath)) {
                    // Attempt to delete the file
                    unlink($destinationPath);
                } 
                $_SESSION['delete'] = "<div class='success'>food deleted successfully</div>";
                header('location:'.SITEURL.'admin-food.php');
            } else {
                $_SESSION['delete'] = '<div class="error">"Error deleting food"</div>';
                header('location:'.SITEURL.'admin-food.php');
            }           
        }
    }else{
        $_SESSION['delete'] = "<div class='error'>Food do not exist</div>";
        header('location:'.SITEURL.'admin-food.php');
    }

?>

