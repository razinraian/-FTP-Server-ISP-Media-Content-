<?php

include "../Model/conectionadmin.php";

$db = new mydb();
$conn = $db->openConn();

$categoryId = 0;

if (isset($_GET["id"]))
{
    $categoryId = intval($_GET["id"]);
}


$categoryName = "";

$stmt = $conn->prepare(
    "SELECT id, name
     FROM categories
     WHERE id = ?"
);

$stmt->bind_param("i", $categoryId);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0)
{
    $category = $result->fetch_assoc();

    $categoryName = $category["name"];
}


/* Subcategories */

$subcategories = array();

$stmt = $conn->prepare(
    "SELECT id, name
     FROM categories
     WHERE parent_id = ?"
);

$stmt->bind_param("i", $categoryId);
$stmt->execute();

$result = $stmt->get_result();

while ($row = $result->fetch_assoc())
{
    $subcategories[] = $row;
}


/* Contents */

$contents = array();

$stmt = $conn->prepare(
    "SELECT c.id,
            c.title,
            c.description,
            c.file_path,
            c.download_count,
            cat.name AS category_name
     FROM contents c
     JOIN categories cat
     ON c.category_id = cat.id
     WHERE c.category_id = ?
     OR cat.parent_id = ?
     ORDER BY c.uploaded_at DESC"
);

$stmt->bind_param(
    "ii",
    $categoryId,
    $categoryId
);

$stmt->execute();

$result = $stmt->get_result();

while ($row = $result->fetch_assoc())
{
    $contents[] = $row;
}

?>