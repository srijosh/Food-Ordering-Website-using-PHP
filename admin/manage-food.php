<?php include('partials/menu.php'); ?>

<div class="main">
    <div class="container">
        <h1>Manage Food</h1>

        <br /><br />

        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

        <br /><br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Discount</th>
                <th>New Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            $sql = "SELECT * FROM tbl_food";


            $res = mysqli_query($conn, $sql);


            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
           
                while ($row = mysqli_fetch_assoc($res)) {
                  
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $discount = $row['discount'];
                    $new_price = $row['new_price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>

                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $title; ?></td>
                        <td>Rs. <?php echo $price; ?></td>
                        <td><?php echo $discount; ?>%</td>
                        <td>Rs. <?php echo $new_price; ?></td>
                        <td>
                            <?php
                            //CHeck whether we have image or not
                            if ($image_name == "") {
                                //WE do not have image, DIslpay Error Message
                                echo "<div class='error'>Image not Added.</div>";
                            } else {
                                //WE Have Image, Display Image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>

                        <td>
                            <span class="adjust">
                                <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                            </span>
                        </td>

                    </tr>

            <?php
                }
            } else {
              
                echo "<tr> <td colspan='7' class='error'> Food not Added Yet. </td> </tr>";
            }

            ?>


        </table>
    </div>

</div>