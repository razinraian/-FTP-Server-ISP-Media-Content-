<?php
include "../controllers/loginValidationadmin.php";
?>

<!DOCTYPE html>
<html>

<head>

    <title>FTP Server Login</title>

    <link rel="stylesheet" href="../CSS/styleadmin.css">

</head>

<body class="login-page">

<div class="login-box">

    <div class="ftp-title">
        FTP Server
    </div>

    <div class="ftp-subtitle">
        Web Client
    </div>

    <?php

    if (isset($_GET["message"]))
    {
        echo "<p class='success'>" .
             $_GET["message"] .
             "</p>";
    }

    ?>

    <form method="POST" action="">

        <label>Email</label>

        <input type="text"
               name="email"
               value="<?php echo $email; ?>"
               placeholder="Enter your email">

        <span class="error">
            <?php echo $emailErr; ?>
        </span>


        <label>Password</label>

        <input type="password"
               name="password"
               placeholder="Enter your password">

        <span class="error">
            <?php echo $passwordErr; ?>
        </span>


        <div class="remember-box">

            <input type="checkbox"
                   name="remember"
                   value="1">

            <span>Remember me</span>

        </div>


        <p class="error login-error">
            <?php echo $loginErr; ?>
        </p>


        <button type="submit"
                class="login-button">

            Login

        </button>

    </form>


    <p class="register-text">

        Don't have an account?

        <a href="registeradmin.php">
            Register
        </a>

    </p>

</div>

</body>
</html>