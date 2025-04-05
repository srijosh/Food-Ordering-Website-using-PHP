<?php ob_start();
include('partials-front/menu.php'); ?>

<div class="account-container">
    <h1 class="text-center" style="color: #FF9D23;">User Account</h1>

    <?php
    // Check if the user is logged in
    if (!isset($_SESSION['user'])) {
        $_SESSION['no-login-message'] = "Please login to access this page.";
        header("location:" . SITEURL . 'login.php');
        exit();
    }

    // Get user details
    $username = $_SESSION['user'];
    $sql = "SELECT * FROM tbl_user WHERE username='$username'";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $full_name = $row['full_name'];
            $email = $row['email'];
            $address = $row['address'];
            $contact = $row['contact'];
        } else {
            $_SESSION['no-login-message'] = "User not found.";
            header("location:" . SITEURL . 'login.php');
            exit();
        }
    }
    ?>

    <?php
    if (isset($_SESSION['update-message'])) {
        echo "<div class='message'>" . $_SESSION['update-message'] . "</div>";
        unset($_SESSION['update-message']);
    }
    ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo $full_name; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact</label>
            <input type="text" id="contact" name="contact" value="<?php echo $contact; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">New Password (leave blank to keep current)</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm New Password (leave blank to keep current)</label>
            <input type="password" id="confirm_password" name="confirm_password">
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Update">
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);


    if (!preg_match('/^98\d{8}$/', $contact)) {
        $_SESSION['update-message'] = "Invalid contact number. It should start with 98 and be exactly 10 digits long.";
        header("location:" . SITEURL . 'account.php');
        exit();
    }
    // Check if passwords match
    if (!empty($password) && $password !== $confirm_password) {
        $_SESSION['update-message'] = "Passwords do not match.";
        header("location:" . SITEURL . 'account.php');
        exit();
    }

    $update_sql = "UPDATE tbl_user SET 
            full_name='$full_name',
            email='$email',
            address='$address',
            contact='$contact'
        ";

    if (!empty($password)) {
        $hashed_password = sha1($password);
        $update_sql .= ", password='$hashed_password'";
    }

    $update_sql .= " WHERE username='$username'";

    $update_res = mysqli_query($conn, $update_sql);

    if ($update_res == TRUE) {
        $_SESSION['update-message'] = "Account updated successfully.";
    } else {
        $_SESSION['update-message'] = "Failed to update account.";
    }

    header("location:" . SITEURL . 'account.php');
    exit();
}
ob_start();
?>