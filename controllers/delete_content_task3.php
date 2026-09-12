<?php
include "../models/ContentModel.php";

header('Content-Type: application/json');

$response = array();

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $contentModel = new ContentModel();
    $result = $contentModel->deleteContent($id);

    if ($result) {
        $response['success'] = true;
        $response['message'] = "Content deleted successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Failed to delete content";
    }
} else {
    $response['success'] = false;
    $response['message'] = "No ID provided";
}

echo json_encode($response);
?>