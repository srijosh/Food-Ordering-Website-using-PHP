<?php include('partials/menu.php'); ?>

<div class="main">
    <div class="order-container">
        <h1>Manage Order</h1>

        <br /><br /><br />

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Delivery Status</th>
                <th>Payment Status</th>
                <th>Customer Name</th>
                <th>Contact</th>

                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php

            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                //Order Available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get all the order details
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $payment_status = $row['payment_status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_address = $row['customer_address'];

            ?>

                    <tr>
                        <td data-label="S.N."><?php echo $sn++; ?>. </td>
                        <td data-label="Food"><?php echo $food; ?></td>
                        <td data-label="Price"><?php echo $price; ?></td>
                        <td data-label="Qty."><?php echo $qty; ?></td>
                        <td data-label="Total"><?php echo $total; ?></td>
                        <td data-label="Order Date"><?php echo $order_date; ?></td>

                        <td data-label="Delivery Status">
                            <?php


                            if ($status == "Ordered") {
                                echo "<label>$status</label>";
                            } elseif ($status == "On Delivery") {
                                echo "<label style='color: orange;'>$status</label>";
                            } elseif ($status == "Delivered") {
                                echo "<label style='color: green;'>$status</label>";
                            } elseif ($status == "Cancelled") {
                                echo "<label style='color: red;'>$status</label>";
                            }
                            ?>
                        </td>
                        <td data-label="Payment Status">
                            <?php echo $payment_status; ?>
                        </td>
                        <td data-label="Customer Name"><?php echo $customer_name; ?></td>
                        <td data-label="Contact"><?php echo $customer_contact; ?></td>

                        <td data-label="Address"><?php echo $customer_address; ?></td>
                        <td data-label="Actions">
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                        </td>
                    </tr>

            <?php

                }
            } else {
                //Order not Available
                echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
            }
            ?>


        </table>
    </div>

</div>