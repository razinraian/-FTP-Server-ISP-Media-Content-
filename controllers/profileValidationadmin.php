<?php

session_start();

if (!isset($_SESSION["user_id"]))
{
    header("Location: loginadmin.php");
    exit();
}

include "../Model/conectionadmin.php";

$db = new mydb();
$conn = $db->openConn();

$userId = $_SESSION["user_id"];

$name = "";
$email = "";

$profileErr = "";
$passwordErr = "";
$pictureErr = "";

$success = "";

$stmt = $conn->prepare(
    "SELECT name, email, password_hash, profile_picture
     FROM users
     WHERE id = ?"
);

$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

$name = $user["name"];
$email = $user["email"];


/* Update Name and Email */

if (
    $_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["updateProfile"])
)
{
    $newName = trim($_POST["name"]);
    $newEmail = trim($_POST["email"]);

    if (empty($newName))
    {
        $profileErr = "Name is required";
    }
    elseif (!filter_var($newEmail, FILTER_VALIDATE_EMAIL))
    {
        $profileErr = "Invalid email";
    }
    else
    {
        $check = $conn->prepare(
            "SELECT id FROM users
             WHERE email = ? AND id != ?"
        );

        $check->bind_param(
            "si",
            $newEmail,
            $userId
        );

        $check->execute();

        $checkResult = $check->get_result();

        if ($checkResult->num_rows > 0)
        {
            $profileErr = "Email already exists";
        }
        else
        {
            $update = $conn->prepare(
                "UPDATE users
                 SET name = ?, email = ?
                 WHERE id = ?"
            );

            $update->bind_param(
                "ssi",
                $newName,
                $newEmail,
                $userId
            );

            if ($update->execute())
            {
                $_SESSION["name"] = $newName;

                $name = $newName;
                $email = $newEmail;

                $success = "Profile updated successfully";
            }
        }
    }
}


/* Upload Profile Picture */

if (
    $_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["uploadPicture"])
)
{
    if (isset($_FILES["profile_picture"]) &&
        $_FILES["profile_picture"]["error"] == 0)
    {
        $fileName = $_FILES["profile_picture"]["name"];
        $fileSize = $_FILES["profile_picture"]["size"];
        $fileTmp = $_FILES["profile_picture"]["tmp_name"];

        $extension =
            strtolower(
                pathinfo($fileName, PATHINFO_EXTENSION)
            );

        $allowed = array(
            "jpg",
            "jpeg",
            "png"
        );

        if (!in_array($extension, $allowed))
        {
            $pictureErr =
                "Only JPG, JPEG and PNG files are allowed";
        }
        elseif ($fileSize > 2 * 1024 * 1024)
        {
            $pictureErr =
                "File size must be less than 2MB";
        }
        else
        {
            $uploadFolder = "../public/uploads/";

            if (!is_dir($uploadFolder))
            {
                mkdir($uploadFolder, 0777, true);
            }

            $newFileName =
                uniqid() . "." . $extension;

            $target =
                $uploadFolder . $newFileName;

            if (move_uploaded_file($fileTmp, $target))
            {
                $update = $conn->prepare(
                    "UPDATE users
                     SET profile_picture = ?
                     WHERE id = ?"
                );

                $update->bind_param(
                    "si",
                    $newFileName,
                    $userId
                );

                $update->execute();

                $success =
                    "Profile picture uploaded successfully";
            }
        }
    }
}


/* Change Password */

if (
    $_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["changePassword"])
)
{
    $currentPassword = $_POST["currentPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmNewPassword =
        $_POST["confirmNewPassword"];

    $stmt = $conn->prepare(
        "SELECT password_hash
         FROM users
         WHERE id = ?"
    );

    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    if (!password_verify(
        $currentPassword,
        $userData["password_hash"]
    ))
    {
        $passwordErr =
            "Current password is incorrect";
    }
    elseif (strlen($newPassword) < 8)
    {
        $passwordErr =
            "New password must be at least 8 characters";
    }
    elseif ($newPassword != $confirmNewPassword)
    {
        $passwordErr =
            "New passwords do not match";
    }
    else
    {
        $newHash =
            password_hash(
                $newPassword,
                PASSWORD_DEFAULT
            );

        $update = $conn->prepare(
            "UPDATE users
             SET password_hash = ?
             WHERE id = ?"
        );

        $update->bind_param(
            "si",
            $newHash,
            $userId
        );

        if ($update->execute())
        {
            $success =
                "Password changed successfully";
        }
    }
}

?>