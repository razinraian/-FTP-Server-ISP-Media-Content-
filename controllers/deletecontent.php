<?php
include "../models/ContentModel.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $contentModel = new ContentModel();

    
    $content = $contentModel->getContentById($id);
    if ($content) {
        $filePath = "../" . $content['file_path'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    $contentModel->deleteContent($id);
}

header("Location: ../views/managecontents.php");
exit();
?>