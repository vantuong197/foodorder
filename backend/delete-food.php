<?php
    // Get id of ad to be deleted
    include("../config/constants.php");
    include('check-login.php');
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) >0){
        while($row = mysqli_fetch_assoc($res)){
            print_r($row);
            die();
        }
    }
    $destinationPath = "../frontend/images/categorys/" . $imageName;
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        if (file_exists($destinationPath)) {
            // Attempt to delete the file
            unlink($destinationPath);
        } 
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully</div>";
        header('location:'.SITEURL.'admin-category.php');
    } else {
        $_SESSION['delete'] = '<div class="error">"Error deleting Category"</div>';
        header('location:'.SITEURL.'admin-category.php');
    }
    // Create SQL query to delete admin

    // redirect to manage admin page with message success or failed
