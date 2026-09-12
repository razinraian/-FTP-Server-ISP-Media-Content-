<?php
include "../models/RequestModel.php";
include "../models/ContentModel.php";

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    $requestModel = new RequestModel();
    $requestModel->incrementDownloadCount($id);

    $contentModel = new ContentModel();
    $content = $contentModel->getContentById($id);

    if ($content) {
        header("Location: ../" . $content['file_path']);
        exit();
    }
}

echo "File not found";
?>