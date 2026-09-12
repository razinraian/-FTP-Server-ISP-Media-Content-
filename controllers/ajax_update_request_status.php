<?php
include "../models/RequestModel.php";

header('Content-Type: application/json');

$response = array();

if (isset($_GET["id"]) && isset($_GET["status"])) {
    $id = intval($_GET["id"]);
    $status = $_GET["status"];

    $requestModel = new RequestModel();
    $result = $requestModel->updateRequestStatus($id, $status);

    if ($result) {
        $response['success'] = true;
        $response['message'] = "Status updated successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Failed to update status";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Missing parameters";
}

echo json_encode($response);
?>