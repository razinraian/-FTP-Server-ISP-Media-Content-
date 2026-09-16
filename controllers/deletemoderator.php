<?php
include "../models/UserModel.php";

$userModel = new UserModel();
$successMsg = "";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($userModel->deleteModerator($id)) {
        $successMsg = "User deleted successfully";
    } else {
        $successMsg = "Failed to delete user";
    }
}

$allUsers = $userModel->getAllUsers();
?>