<?php
session_start();
include "../models/ContentModel.php";

$titleErr = "";
$descriptionErr = "";
$categoryErr = "";
$fileErr = "";
$successMsg = "";

$title = "";
$description = "";
$category = "";

$contentModel = new ContentModel();
$categories = $contentModel->getAllCategories();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["title"])) {
        $titleErr = "Title is required";
    } elseif (!preg_match("/^[a-zA-Z0-9 ]*$/", $_POST["title"])) {
        $titleErr = "Only letters, numbers and white space allowed";
    } else {
        $title = test_input($_POST["title"]);
    }

    if (empty($_POST["description"])) {
        $descriptionErr = "Description is required";
    } elseif (strlen($_POST["description"]) < 10) {
        $descriptionErr = "Description must be at least 10 characters";
    } else {
        $description = test_input($_POST["description"]);
    }

    if (empty($_POST["category"])) {
        $categoryErr = "Category is required";
    } else {
        $category = test_input($_POST["category"]);
    }

    // ---- file upload ----
    $filePath = "";

    if (empty($_FILES["file"]["name"])) {
        $fileErr = "File is required";
    } else {
        $fileExt = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $newFileName = uniqid("content_", true) . "." . $fileExt;
        $filePath = "public/uploads/contents/" . $newFileName;

        // ei line ta age missing chilo -- eijonno file actual e server e save hocchilo na
        move_uploaded_file($_FILES["file"]["tmp_name"], "../public/uploads/contents/" . $newFileName);
    }

    if ($titleErr == "" && $descriptionErr == "" && $categoryErr == "" && $fileErr == "") {

        // TODO: Task 1 er login/session ready hole eta $_SESSION['user_id'] diye replace korte hobe
        $uploaderId = $_SESSION['user_id'];

        $result = $contentModel->insertContent($title, $description, $filePath, $category, $uploaderId);

        if ($result) {
            $successMsg = "Content submitted successfully";
            $title = $description = $category = "";
        } else {
            $successMsg = "Database insert failed";
        }
    }
}

$allContents = $contentModel->getAllContents();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}
?>