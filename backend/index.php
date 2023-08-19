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

        <div class="col-4">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Content Section end -->
<!-- Footer Start -->
<?php
include_once("./components/footer.php")
?>