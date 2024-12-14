<?php
include('config/constants.php');
//check if user is logged in before adding to cart
include('user-login-check.php');

if (isset($_POST['submit'])) {
    $food_id = $_POST['food_id'];
    $review_text = $_POST['review_text'];
    $review_rating = $_POST['rating'];
    $username = $_SESSION['user']; // Assuming username is stored in session after login

    // Fetch user_id using the username
    $sql_user = "SELECT id FROM tbl_user WHERE username='$username'";
    $res_user = mysqli_query($conn, $sql_user);

    if ($res_user == true) {
        $row_user = mysqli_fetch_assoc($res_user);
        $user_id = $row_user['id'];

        // Insert review into database
        $sql = "INSERT INTO tbl_ratings (food_id, user_id, rating, description) VALUES ('$food_id', '$user_id', '$review_rating', '$review_text')";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['review'] = "Review added successfully!";
            $sql_interaction = "INSERT INTO tbl_user_interactions (user_id, food_id, interaction_type) VALUES ('$user_id', '$food_id', 'review')";
            mysqli_query($conn, $sql_interaction);
        } else {
            $_SESSION['review'] = "Failed to add review!";
        }

        header('location:' . SITEURL . 'food_info.php?food_id=' . $food_id);
    } else {
        $_SESSION['review'] = "User not found";
        header('location:' . SITEURL . 'food_info.php?food_id=' . $food_id);
    }
}
