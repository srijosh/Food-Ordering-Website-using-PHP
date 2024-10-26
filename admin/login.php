<?php include('../config/constants.php'); ?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <div class="login-container">
        <h1>Admin Login</h1>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-admin-login-message'])) {
            echo $_SESSION['no-admin-login-message'];
            unset($_SESSION['no-admin-login-message']);
        }
        ?>

        <!-- Login Form Starts HEre -->
        <form action="" method="POST" class="text-center">
            <input type="text" name="username" placeholder="Enter Username">
            <input type="password" name="password" placeholder="Enter Password">

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
        <!-- Login Form Ends HEre -->

    </div>

</body>

</html>

<?php


if (isset($_POST['submit'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $raw_password = sha1($_POST['password']);
    $password = mysqli_real_escape_string($conn, $raw_password);


    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";


    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {

        $_SESSION['login'] = "Login Successful!";
        $_SESSION['admin'] = $username;

        //REdirect to HOme Page/Dashboard
        header('location:' . SITEURL . 'admin/');
    } else {

        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        //REdirect to HOme Page/Dashboard
        header('location:' . SITEURL . 'admin/login.php');
    }
}

?>