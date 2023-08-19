<?php
    // Get id of ad to be deleted
    include("../config/constants.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['delete'] = "Admin account deleted successfully";
        header('location:'.SITEURL.'admin.php');
      } else {
        $_SESSION['delete'] = "Error deleting record: " . mysqli_error($conn);
        header('location:'.SITEURL.'admin.php');
      }
    // Create SQL query to delete admin

    // redirect to manage admin page with message success or failed
