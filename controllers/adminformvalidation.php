<?php
include "../models/UserModel.php";

$name = "";
$email = "";
$password = "";
$confirm_password = "";
$role = "";

$nameErr = "";
$emailErr = "";
$passwordErr = "";
$confirmErr = "";
$roleErr = "";
$successMsg = "";

$userModel = new UserModel();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mysubmit"])) {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $role = $_POST["role"];

    if ($name == "") {
        $nameErr = "Name is required";
    }

    if ($email == "") {
        $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } elseif ($userModel->emailExists($email)) {
        $emailErr = "This email is already registered";
    }

    if ($password == "") {
        $passwordErr = "Password is required";
    } elseif (strlen($password) < 8) {
        $passwordErr = "Password must be at least 8 characters";
    }

    if ($confirm_password == "") {
        $confirmErr = "Please confirm the password";
    } elseif ($password != $confirm_password) {
        $confirmErr = "Passwords do not match";
    }

    if ($role == "") {
        $roleErr = "Role is required";
    }

    
    $filename = "";
    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0) {
        $fileExt = pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION);
        $filename = uniqid("profile_", true) . "." . $fileExt;
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], "../public/uploads/" . $filename);
    }

    if ($nameErr == "" && $emailErr == "" && $passwordErr == "" && $confirmErr == "" && $roleErr == "") {
        $result = $userModel->insertUser($name, $email, $password, $role, $filename);

        if ($result) {
            $successMsg = "User added successfully";
            $name = $email = $password = $confirm_password = $role = "";
        } else {
            $successMsg = "Failed to add user";
        }
    }
}
?>