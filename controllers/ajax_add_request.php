<?php
include "../models/RequestModel.php";

header('Content-Type: application/json');

$response = array();

if (isset($_POST["content_title"])) {

    $contentTitle = trim($_POST["content_title"]);
    $categoryRequested = $_POST["category_requested"];
    $message = trim($_POST["message"]);

    if ($contentTitle == "") {
        $response['success'] = false;
        $response['message'] = "Content title is required";
    } else {
        $requestModel = new RequestModel();
        $requesterIp = $_SERVER['REMOTE_ADDR'];

        $result = $requestModel->addRequest($contentTitle, $categoryRequested, $message, $requesterIp);

        if ($result) {
            $response['success'] = true;
            $response['message'] = "Your request has been submitted successfully";
        } else {
            $response['success'] = false;
            $response['message'] = "Failed to submit request";
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = "No data provided";
}

echo json_encode($response);
?>