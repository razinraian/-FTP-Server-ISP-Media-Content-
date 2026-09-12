<?php

$name = "";
$email = "";
$password = "";
$confirmPassword = "";
$role = "";

$nameErr = "";
$emailErr = "";
$passwordErr = "";
$confirmPasswordErr = "";
$roleErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $role = $_POST["role"];

    if (empty($name))
    {
        $nameErr = "Name is required";
    }

    if (empty($email))
    {
        $emailErr = "Email is required";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $emailErr = "Invalid email format";
    }

    if (empty($password))
    {
        $passwordErr = "Password is required";
    }
    elseif (strlen($password) < 8)
    {
        $passwordErr = "Password must be at least 8 characters";
    }

    if (empty($confirmPassword))
    {
        $confirmPasswordErr = "Confirm password is required";
    }
    elseif ($password != $confirmPassword)
    {
        $confirmPasswordErr = "Passwords do not match";
    }

    if ($role != "admin" && $role != "moderator")
    {
        $roleErr = "Please select a valid role";
    }

    if (
        $nameErr == "" &&
        $emailErr == "" &&
        $passwordErr == "" &&
        $confirmPasswordErr == "" &&
        $roleErr == ""
    )
    {
        include "../models/db_connection.php";

        $conn = getConnection();

        $check = $conn->prepare(
            "SELECT id FROM users WHERE email = ?"
        );

        $check->bind_param("s", $email);
        $check->execute();

        $result = $check->get_result();

        if ($result->num_rows > 0)
        {
            $emailErr = "Email already exists";
        }
        else
        {
            $passwordHash = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $stmt = $conn->prepare(
                "INSERT INTO users
                (name, email, password_hash, role)
                VALUES (?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "ssss",
                $name,
                $email,
                $passwordHash,
                $role
            );

            if ($stmt->execute())
            {
                header("Location: loginadmin.php?message=Registration successful");
                exit();
            }
        }

        $conn->close();
    }
}

?>