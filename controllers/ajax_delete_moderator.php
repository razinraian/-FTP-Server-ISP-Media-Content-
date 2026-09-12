<?php
include "../models/UserModel.php";

header('Content-Type: application/json');

$response = array();

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $userModel = new UserModel();
    $result = $userModel->deleteModerator($id);

    if ($result) {
        $response['success'] = true;
        $response['message'] = "User deleted successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Failed to delete user";
    }
} else {
    $response['success'] = false;
    $response['message'] = "No ID provided";
}

echo json_encode($response);
?>