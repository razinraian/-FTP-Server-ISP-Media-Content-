<?php
include "../controllers/validationadmin.php";
?>

<!DOCTYPE html>
<html>
<head>

    <title>Registration</title>

    <link rel="stylesheet" href="../css/styleadmin.css">

    <script src="../js/validationadmin.js"></script>

</head>

<body>

<div class="container">

    <h2>Registration</h2>

    <form method="POST"
          action=""
          onsubmit="return validateRegistration()">

        <label>Name</label>

        <input type="text"
               id="name"
               name="name"
               value="<?php echo $name; ?>">

        <span class="error">
            <?php echo $nameErr; ?>
        </span>


        <label>Email</label>

        <input type="text"
               id="email"
               name="email"
               value="<?php echo $email; ?>">

        <span class="error">
            <?php echo $emailErr; ?>
        </span>


        <label>Password</label>

        <input type="password"
               id="password"
               name="password">

        <span class="error">
            <?php echo $passwordErr; ?>
        </span>


        <label>Confirm Password</label>

        <input type="password"
               id="confirmPassword"
               name="confirmPassword">

        <span class="error">
            <?php echo $confirmPasswordErr; ?>
        </span>


        <label>Role</label>

        <select id="role" name="role">

            <option value="">Select Role</option>

            <option value="admin"
                <?php if ($role == "admin") echo "selected"; ?>>
                Admin
            </option>

            <option value="moderator"
                <?php if ($role == "moderator") echo "selected"; ?>>
                Moderator
            </option>

        </select>

        <span class="error">
            <?php echo $roleErr; ?>
        </span>


        <button type="submit">
            Register
        </button>

    </form>

    <p>
        Already have an account?
        <a href="loginadmin.php">Login</a>
    </p>

</div>

</body>
</html>