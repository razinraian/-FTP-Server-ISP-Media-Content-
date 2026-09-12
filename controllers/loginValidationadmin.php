<?php

session_start();

$email = "";
$password = "";

$emailErr = "";
$passwordErr = "";
$loginErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email))
    {
        $emailErr = "Email is required";
    }

    if (empty($password))
    {
        $passwordErr = "Password is required";
    }

    if ($emailErr == "" && $passwordErr == "")
    {
        include "../models/db_connection.php";

        $conn = getConnection();

        $stmt = $conn->prepare(
            "SELECT id, name, password_hash, role
             FROM users
             WHERE email = ?"
        );

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1)
        {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user["password_hash"]))
            {
                session_regenerate_id(true);

                $_SESSION["user_id"] = $user["id"];
                $_SESSION["name"] = $user["name"];
                $_SESSION["role"] = $user["role"];


                if (strtolower($user["role"]) == "moderator")
                {
                    header("Location: ../views/contentsubmission.php");
                    exit();
                }

                elseif (strtolower($user["role"]) == "admin")
                {
                   header("Location: ../views/admindashboard.php");
                   exit();
                }

                else
                {
                    header("Location: ../views/indexadmin.php");
                    exit();
                }
            }
            else
            {
                $loginErr = "Invalid email or password";
            }
        }
        else
        {
            $loginErr = "Invalid email or password";
        }

        $conn->close();
    }
}

?>