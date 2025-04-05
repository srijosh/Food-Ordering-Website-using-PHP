<?php include('config/constants.php'); ?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone&family=Lugrasimo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

    <div class="login-container">
        <h1 style="color: #FF9D23;">User Login</h1>

        <?php
        if (isset($_SESSION['add-user'])) {
            echo "<div class='success'>" . $_SESSION['add-user'] . "</div>";
            unset($_SESSION['add-user']);
        }

        if (isset($_SESSION['no-user-login-message'])) {
            echo $_SESSION['no-user-login-message'];
            unset($_SESSION['no-user-login-message']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo "<div class='error'>" . $_SESSION['no-login-message'] . "</div>";
            unset($_SESSION['no-login-message']);
        }
        ?>

        <form action="" method="POST">
            <input type="text" name="username" placeholder="Enter Username">
            <input type="password" name="password" placeholder="Enter Password">
            <input type="submit" name="submit" value="Login">
        </form>

        <p>Don't have an account? <a style="color: #C14600; text-decoration: none;" href="add-user.php">Sign up here</a></p>
    </div>

</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $raw_password = sha1($_POST['password']);
    $password = mysqli_real_escape_string($conn, $raw_password);

    $sql = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // $_SESSION['login'] = "Login Successful.";
        $_SESSION['user'] = $username;

        header('location:' . SITEURL . '');
        $_SESSION['login-message'] = "Logged In Successfully!";
    } else {
        $_SESSION['no-login-message'] = "Username or Password did not match.";
        header('location:' . SITEURL . 'login.php');
    }
}
?>