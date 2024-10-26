<?php
include('partials-front/menu.php');
if (isset($_SESSION['review'])) {
    echo '<script>alert("' . $_SESSION['review'] . '");</script>';
    unset($_SESSION['review']);
}

if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];

    // Query to get food details
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // Food available
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $discount = $row['discount'];
        $new_price = $row['new_price'];
        $description = $row['description'];
        $image_name = $row['image_name'];
    } else {
        // Food not available
        header('location:' . SITEURL . '');
    }
} else {
    // Redirect to home page
    header('location:' . SITEURL . '');
}
?>

<!-- Food Details Section Starts Here -->
<section class="food-details">
    <div class="container">
        <div class="food-details-box">
            <div class="food-details-img">
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

            <div class="food-details-desc">
                <h3><?php echo $title; ?></h3>
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
                    <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                    <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                </form>
            </div>
        </div>

        <!-- Reviews Section Starts Here -->
        <div class="reviews">
            <h3>Customer Reviews</h3>
            <br>

            <?php
            // Query to get reviews and calculate average rating
            $sql_reviews = "SELECT rating, description FROM tbl_ratings WHERE food_id=$food_id";
            $res_reviews = mysqli_query($conn, $sql_reviews);
            $count_reviews = mysqli_num_rows($res_reviews);

            if ($count_reviews > 0) {
                $total_rating = 0;

                while ($row_reviews = mysqli_fetch_assoc($res_reviews)) {
                    $total_rating += $row_reviews['rating'];
                }

                $average_rating = $total_rating / $count_reviews;

                echo "<p style='color:#7b6cfd;'>Average Rating: " . round($average_rating, 1) . " out of 5 (" . $count_reviews . " reviews)</p>";


                // This function is used to move the internal pointer of the result set $res_reviews to the specified row. The second parameter 0 indicates the first row.
                mysqli_data_seek($res_reviews, 0);

                $review_count = 0;
                while ($row_reviews = mysqli_fetch_assoc($res_reviews)) {
                    $review_text = $row_reviews['description'];
                    $review_rating = $row_reviews['rating'];
                    $review_count++;
            ?>
                    <div class="review-box <?php echo $review_count > 2 ? 'hidden' : ''; ?>">
                        <div class="review-rating">
                            <?php for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $review_rating) {
                                    echo "<span class='star filled'>&#9733;</span>";
                                } else {
                                    echo "<span class='star'>&#9734;</span>";
                                }
                            } ?>
                        </div>
                        <p><?php echo $review_text; ?></p>
                    </div>
            <?php
                }

                if ($count_reviews > 2) {
                    echo "<button id='show-more-reviews' class='btn btn-primary' onclick='showMoreReviews()'>Show More Reviews</button><br><br><br><br>";
                }
            } else {
                echo "<p class='error'>No reviews yet.</p><br><br>";
            }
            ?>
            <br>
            <!-- Add Review Form -->
            <h3>Add Your Review</h3>
            <form action="add_review.php" method="POST" class="add-review-form">
                <fieldset>
                    <legend>Your Rating:</legend>
                    <div class="rating-input">
                        <input type="radio" name="rating" value="1" required> 1
                        <input type="radio" name="rating" value="2"> 2
                        <input type="radio" name="rating" value="3"> 3
                        <input type="radio" name="rating" value="4"> 4
                        <input type="radio" name="rating" value="5"> 5
                    </div>
                </fieldset>
                <textarea name="review_text" placeholder="Write your review here..." required></textarea>
                <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                <input type="submit" name="submit" value="Add Review" class="btn btn-primary">
            </form>
        </div>
        <!-- Reviews Section Ends Here -->

    </div>
</section>
<!-- Food Details Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

<script>
    function showMoreReviews() {
        var hiddenReviews = document.querySelectorAll('.review-box.hidden');
        hiddenReviews.forEach(function(review) {
            review.classList.remove('hidden');
        });

        var showMoreButton = document.getElementById('show-more-reviews');
        if (showMoreButton) {
            showMoreButton.style.display = 'none';
        }
    }
</script>