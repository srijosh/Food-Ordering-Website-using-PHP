<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main">
    <div class="container">
        <h1 class="text-center">Dashboard</h1>
        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo '<script>alert("' . $_SESSION['login'] . '");</script>';
            unset($_SESSION['login']);
        }
        ?>
        <br><br>
        <div class="info">
            <div class="part">

                <?php
                //Sql Query 
                $sql = "SELECT * FROM tbl_category";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                ?>

                <h1><?php echo $count; ?></h1>
                <br />
                Categories
            </div>

            <div class="part">

                <?php

                $sql2 = "SELECT * FROM tbl_food";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);
                ?>

                <h1><?php echo $count2; ?></h1>
                <br />
                Foods
            </div>

            <div class="part">

                <?php

                $sql3 = "SELECT * FROM tbl_order";

                $res3 = mysqli_query($conn, $sql3);

                $count3 = mysqli_num_rows($res3);
                ?>

                <h1><?php echo $count3; ?></h1>
                <br />
                Total Orders
            </div>

            <div class="part">

                <?php

                $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";


                $res4 = mysqli_query($conn, $sql4);


                $row4 = mysqli_fetch_assoc($res4);


                $total_revenue = $row4['Total'];

                ?>

                <h1>Rs. <?php echo $total_revenue; ?></h1>
                <br />
                Revenue Generated
            </div>
        </div>

    </div>
</div>
<!-- Main Content Setion Ends -->