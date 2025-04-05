<?php
ob_start();
include('partials/menu.php'); ?>
<?php

if (isset($_GET['id'])) {

    $id = $_GET['id'];


    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

    $res2 = mysqli_query($conn, $sql2);


    $row2 = mysqli_fetch_assoc($res2);


    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {

    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>


<div class="main">
    <div class="container">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Original Price: </td>
                    <td>
                        <input type="number" id="price" name="price" value="<?php echo $price; ?>" oninput="calculateNewPrice()">
                    </td>
                </tr>
                <tr>
                    <td>Discount in Percentage: </td>
                    <td>
                        <input type="number" id="discount" name="discount" value="0" placeholder="In Percentage" oninput="calculateNewPrice()">
                    </td>
                </tr>
                <tr>
                    <td>New Price: </td>
                    <td>
                        <input type="number" id="new_price" name="new_price" readonly>
                    </td>
                </tr>



                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            //Image not Available 
                            echo "<div class='error'>Image not Available.</div>";
                        } else {
                            //Image Available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                        <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php

                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);


                            if ($count > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];


                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php
                                }
                            } else {

                                echo "<option value='0'>Category Not Available.</option>";
                            }

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

        if (isset($_POST['submit'])) {

            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            if ($_POST['price'] !== '') {
                $price = $_POST['price'];
                $new_price = $_POST['new_price'];
            } else {
                $price = 0;
                $new_price = 0;
            }

            if ($_POST['discount'] !== '') {
                $discount = $_POST['discount'];
            } else {
                $discount = 0;
            }
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];

            $featured = $_POST['featured'];
            $active = $_POST['active'];



            if (isset($_FILES['image']['name'])) {
                //Upload BUtton Clicked
                $image_name = $_FILES['image']['name'];


                if ($image_name != "") {


                    $temp = explode('.', $image_name);
                    $ext = end($temp);

                    $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext;


                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../images/food/" . $image_name;


                    $upload = move_uploaded_file($src_path, $dest_path);

                    if ($upload == false) {

                        $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                        //REdirect to Manage Food 
                        header('location:' . SITEURL . 'admin/manage-food.php');

                        die();
                    }

                    if ($current_image != "") {

                        $remove_path = "../images/food/" . $current_image;

                        $remove = unlink($remove_path);


                        if ($remove == false) {

                            $_SESSION['remove-failed'] = "<div class='error'>Faile to remove current image.</div>";
                            //redirect to manage food
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            //stop the process
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }




            $sql3 = "UPDATE tbl_food SET 
            title = '$title',
            description = '$description',
            price = $price,
            discount = $discount,
            new_price = $new_price,
            image_name = '$image_name', 
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            WHERE id=$id";


            $res3 = mysqli_query($conn, $sql3);


            if ($res3 == true) {

                $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                exit();
            } else {

                $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                exit();
            }
        }
        // Warning: Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\food-order\admin\update-food.php:164) in C:\xampp\htdocs\food-order\admin\update-food.php on line 286
        ob_end_flush(); //This will buffer the output and send it all at once, allowing headers to be modified before the output is sent.

        ?>

    </div>
</div>


<script>
    function calculateNewPrice() {
        var price = document.getElementById('price').value;
        var discount = document.getElementById('discount').value || 0; // default to 0 if discount is empty

        if (price) {
            var new_price = price - (price * discount / 100);
            document.getElementById('new_price').value = Math.round(new_price); // Round to nearest integer
        } else {
            document.getElementById('new_price').value = '';
        }
    }

    // Initialize new price on page load if price and discount are already set
    document.addEventListener('DOMContentLoaded', (event) => {
        calculateNewPrice();
    });
</script>