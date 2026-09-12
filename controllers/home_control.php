<?php
include "../models/RequestModel.php";

$requestModel = new RequestModel();

// category filter (URL theke ashe: home.php?category=4)
$selectedCategory = isset($_GET["category"]) ? $_GET["category"] : "";

$topCategories = $requestModel->getTopCategories();
$allCategories = $requestModel->getAllCategories();
$contents = $requestModel->getContentsByCategory($selectedCategory);

// ---- Request box submission (non-AJAX fallback, PHP validation) ----
$requestTitle = "";
$requestCategory = "";
$requestMessage = "";

$requestTitleErr = "";
$requestSuccessMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_request"])) {

    $requestTitle = trim($_POST["content_title"]);
    $requestCategory = $_POST["category_requested"];
    $requestMessage = trim($_POST["message"]);

    if ($requestTitle == "") {
        $requestTitleErr = "Content title is required";
    }

    if ($requestTitleErr == "") {
        $requesterIp = $_SERVER['REMOTE_ADDR'];
        $result = $requestModel->addRequest($requestTitle, $requestCategory, $requestMessage, $requesterIp);

        if ($result) {
            $requestSuccessMsg = "Your request has been submitted successfully";
            $requestTitle = $requestCategory = $requestMessage = "";
        } else {
            $requestSuccessMsg = "Failed to submit request";
        }
    }
}
?>