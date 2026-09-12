<?php
include "../models/RequestModel.php";

$requestModel = new RequestModel();
$requests = $requestModel->getAllRequests();
?>