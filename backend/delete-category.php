<?php
    // Get id of ad to be deleted
    include("../config/constants.php");
    $id = $_GET['id'];
    $imageName = $_GET['image'];
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
