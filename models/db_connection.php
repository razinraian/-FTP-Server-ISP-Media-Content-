<?php


function getConnection() {
    $conn = new mysqli("localhost", "root", "", "ftp_server");
    if ($conn->connect_error) {
        die("Database Connection Failed: " . $conn->connect_error);
    }
    return $conn;
}
?>