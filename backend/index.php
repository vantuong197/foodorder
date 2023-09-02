<?php
include_once("./components/header.php")
?>
<!-- Menu Section Ends -->

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper text-center">
        <h1>Dashboard</h1>
        <br><br>
        <?php
        if (isset($_SESSION['loginsuccess'])) {
            echo $_SESSION['loginsuccess'];
            unset($_SESSION['loginsuccess']);
        }
        ?>
        <br><br>
        <?php 
            $sql = "SELECT COUNT(id) as cnt FROM tbl_admin";
            $res = mysqli_query($conn, $sql);
            $ROW = mysqli_fetch_object($res);
        ?>
        <div class="col-4">
            <h1><?php echo $ROW->cnt;?></h1>
            <br>
            Admin
        </div>

        <?php 
            $sql2 = "SELECT COUNT(id) as cnt FROM tbl_category";
            $res2 = mysqli_query($conn, $sql2);
            $ROW2 = mysqli_fetch_object($res2);
        ?>
        <div class="col-4">
            <h1><?php echo $ROW2->cnt;?></h1>
            <br>
            Categories
        </div>
        <?php 
            $sql3 = "SELECT COUNT(id) as cnt FROM tbl_food";
            $res3 = mysqli_query($conn, $sql3);
            $ROW3 = mysqli_fetch_object($res3);
        ?>
        <div class="col-4">
            <h1><?php echo $ROW3->cnt;?></h1>
            <br>
            Foods
        </div>
        <?php 
            $sql4 = "SELECT COUNT(id) as cnt FROM tbl_order";
            $res4 = mysqli_query($conn, $sql4);
            $ROW4 = mysqli_fetch_object($res4);
        ?>
        <div class="col-4">
            <h1><?php echo $ROW4->cnt;?></h1>
            <br>
            Orders
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Content Section end -->
<!-- Footer Start -->
<?php
include_once("./components/footer.php")
?>