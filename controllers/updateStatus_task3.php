<?php
include "../models/RequestModel.php";

if (isset($_GET["id"]) && isset($_GET["status"])) {

    $id = intval($_GET["id"]);
    $status = $_GET["status"];

    $requestModel = new RequestModel();
    $result = $requestModel->updateRequestStatus($id, $status);

    if ($result) {
        header("Location: ../views/requestview.php");
        exit();
    } else {
        echo "Status update failed";
    }
}
?>