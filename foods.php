<?php
include('partials-front/menu.php');
?>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Birthstone&family=Lugrasimo&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">

<!-- fOod search Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <div id="search-field">
                <input type="search" id="search-input" name="search" placeholder="Search for Food..." required>
                <button type="submit" id="search-btn" name="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
</section>
<!-- food search Section Ends Here -->

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <div class="foods">
            <?php
            // Getting Foods from Database that are active and featured
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes'";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);

            if ($count2 > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $new_price = $row['new_price'];
                    $discount = $row['discount'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
            ?>

                    <div class="food-menu-box">
                        <a style="color: black;" href="food_info.php?food_id=<?php echo $id; ?>">
                            <div class="food-menu-img">
                                <?php
                                if ($image_name == "") {
                                    echo "<div class='error'>Image not available.</div>";
                                } else {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php
                                }
                                ?>
                            </div>


                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">
                                    <?php if ($price != $new_price) { ?>
                                        <span class="original-price">Rs. <?php echo $price; ?></span> <span class="discount">-<?php echo $discount ?>% </span>
                                        <br><span class="discounted-price">Rs. <?php echo $new_price; ?></span>
                                    <?php } else { ?>
                                        <span class="discounted-price">Rs. <?php echo $new_price; ?></span>
                                    <?php } ?>
                                </p>
                                <p class="food-detail"><?php echo $description; ?></p>
                                <br>
                                <form action="add_to_cart.php" method="POST">
                                    <input type="hidden" name="food_id" value="<?php echo $id; ?>">
                                    <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                                </form>
                            </div>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "<div class='error'>Food not available.</div>";
            }
            ?>
        </div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>