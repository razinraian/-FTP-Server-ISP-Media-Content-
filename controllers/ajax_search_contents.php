<?php
include "../models/RequestModel.php";

header('Content-Type: application/json');

$response = array();

if (isset($_GET["q"])) {
    $keyword = $_GET["q"];
    $requestModel = new RequestModel();
    $contents = $requestModel->searchContents($keyword);

    $response['success'] = true;
    $response['data'] = $contents;
} else {
    $response['success'] = false;
    $response['message'] = "No search term provided";
}

echo json_encode($response);
?>