<?php
include "../models/ContentModel.php";
include "../models/UserModel.php";

$title = "";
$description = "";
$category_id = "";

$titleErr = "";
$descriptionErr = "";
$categoryErr = "";
$successMsg = "";

$contentModel = new ContentModel();
$categories = $contentModel->getAllCategories();


$userModel = new UserModel();
$allUsers = $userModel->getAllUsers();
$uploaderId = $allUsers[0]['id']; 

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


    $filePath = "";

    if (isset($_FILES["content_file"]) && $_FILES["content_file"]["error"] == 0) {
        $fileExt = pathinfo($_FILES["content_file"]["name"], PATHINFO_EXTENSION);
        $newFileName = uniqid("content_", true) . "." . $fileExt;
        $filePath = "public/uploads/contents/" . $newFileName;
        move_uploaded_file($_FILES["content_file"]["tmp_name"], "../public/uploads/contents/" . $newFileName);
    }

    if ($titleErr == "" && $categoryErr == "") {
        $result = $contentModel->insertContent($title, $description, $filePath, $category_id, $uploaderId);

        if ($result) {
            $successMsg = "Content added successfully";
            $title = $description = $category_id = "";
        } else {
            $successMsg = "Failed to add content";
        }
    }
}
?>