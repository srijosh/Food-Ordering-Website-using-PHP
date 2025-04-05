<?php include('config/constants.php'); ?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Food Order System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone&family=Lugrasimo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

    <div class="signup-container">
        <h1 style="color: #FF9D23;">User Sign Up</h1>

        <?php
        if (isset($_SESSION['no-signup-message'])) {
            echo "<div class='error'>" . $_SESSION['no-signup-message'] . "</div>";
            unset($_SESSION['no-signup-message']);
        }
        ?>

        <form action="" method="POST">
            <input type="text" name="full_name" placeholder="Enter Your Name" required>
            <input type="text" name="username" placeholder="Your Username" required>
            <input type="password" name="password" placeholder="Your Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="address" placeholder="Your Address" required>
            <input type="text" name="contact" placeholder="Your Phone Number" required>
            <input type="submit" name="submit" value="Sign Up">
        </form>

        <p>Already have an account? <a style="color: #C14600; text-decoration: none;" href="login.php">Login here</a></p>
    </div>

</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);


    if (!preg_match('/^98\d{8}$/', $contact)) {
        $_SESSION['no-signup-message'] = "Invalid contact number. It should start with 98 and be exactly 10 digits long.";
        header("location:" . SITEURL . 'add-user.php');
        exit();
    }
    // Check if passwords match
    if ($password !== $confirm_password) {
        $_SESSION['no-signup-message'] = "Passwords do not match.";
        header("location:" . SITEURL . 'add-user.php');
        exit();
    }

    // Hash the password
    $hashed_password = sha1($password);

    // Check if the username or email already exists
    $check_sql = "SELECT * FROM tbl_user WHERE username='$username' OR email='$email'";
    $check_res = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_res) > 0) {
        // Username or email already exists
        $_SESSION['no-signup-message'] = "Username or Email already exists.";
        header("location:" . SITEURL . 'add-user.php');
        exit();
    } else {
        $sql = "INSERT INTO tbl_user SET 
                full_name='$full_name',
                username='$username',
                password='$hashed_password',
                email='$email',
                address='$address',
                contact='$contact'
            ";

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $_SESSION['add-user'] = "User Added Successfully.";
            header("location:" . SITEURL . 'login.php');
        } else {
            $_SESSION['no-signup-message'] = "Failed to Add User.";
            header("location:" . SITEURL . 'add-user.php');
        }
    }
}
?>