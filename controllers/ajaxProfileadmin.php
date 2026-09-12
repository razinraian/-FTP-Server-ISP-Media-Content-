<?php

session_start();

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"]))
{
    echo json_encode([
        "success" => false,
        "message" => "Please login first"
    ]);

    exit();
}


include "../Model/conectionadmin.php";

$db = new mydb();
$conn = $db->openConn();

$userId = $_SESSION["user_id"];

$name = trim($_POST["name"]);
$email = trim($_POST["email"]);


if (empty($name))
{
    echo json_encode([
        "success" => false,
        "message" => "Name is required"
    ]);

    exit();
}


if (!filter_var(
    $email,
    FILTER_VALIDATE_EMAIL
))
{
    echo json_encode([
        "success" => false,
        "message" => "Invalid email"
    ]);

    exit();
}


$check = $conn->prepare(
    "SELECT id
     FROM users
     WHERE email = ?
     AND id != ?"
);

$check->bind_param(
    "si",
    $email,
    $userId
);

$check->execute();

$result = $check->get_result();


if ($result->num_rows > 0)
{
    echo json_encode([
        "success" => false,
        "message" => "Email already exists"
    ]);

    exit();
}


$stmt = $conn->prepare(
    "UPDATE users
     SET name = ?, email = ?
     WHERE id = ?"
);

$stmt->bind_param(
    "ssi",
    $name,
    $email,
    $userId
);


if ($stmt->execute())
{
    $_SESSION["name"] = $name;

    echo json_encode([
        "success" => true,
        "message" => "Profile updated successfully"
    ]);
}
else
{
    echo json_encode([
        "success" => false,
        "message" => "Profile update failed"
    ]);
}

?>