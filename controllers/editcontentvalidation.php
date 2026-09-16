<?php
include "../models/ContentModel.php";

$contentModel = new ContentModel();
$categories = $contentModel->getAllCategories();

$id = $_GET["id"] ?? $_POST["id"];
$content = $contentModel->getContentById($id);

$title = $content['title'];
$description = $content['description'];
$category_id = $content['category_id'];

$titleErr = "";
$categoryErr = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mysubmit"])) {

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $category_id = $_POST["category_id"];

    if ($title == "") {
        $titleErr = "Title is required";
    }

    if ($category_id == "") {
        $categoryErr = "Category is required";
    }

    $filePath = null; 

    // jodi notun file select kora hoy tahole update
    if (isset($_FILES["content_file"]) && $_FILES["content_file"]["error"] == 0) {
        $fileExt = strtolower(pathinfo($_FILES["content_file"]["name"], PATHINFO_EXTENSION));
        $newFileName = uniqid("content_", true) . "." . $fileExt;
        $filePath = "public/uploads/contents/" . $newFileName;
        move_uploaded_file($_FILES["content_file"]["tmp_name"], "../public/uploads/contents/" . $newFileName);
    }

    if ($titleErr == "" && $categoryErr == "") {
        $result = $contentModel->updateContent($id, $title, $description, $category_id, $filePath);

        if ($result) {
            $successMsg = "Content updated successfully";
        } else {
            $successMsg = "Failed to update content";
        }
    }
}
?>