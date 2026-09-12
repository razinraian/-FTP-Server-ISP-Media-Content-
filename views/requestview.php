<?php

include "../controllers/requestlist_task3.php";

?>

<a href="contentsubmission.php">
    <button type="button">Back to Moderator Page</button>
</a>

<!DOCTYPE html>

<html>

<head>

    <title>Content Requests</title>
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<h1>Content Requests</h1>

<table border="1">

    <tr>

        <th>ID</th>
        <th>Requester IP</th>
        <th>Content Title</th>
        <th>Category</th>
        <th>Message</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Action</th>

    </tr>

<?php

if (count($requests) > 0) {

    foreach ($requests as $row) {

        echo "<tr id='request-row-" . $row["id"] . "'>";

        echo "<td>" . $row["id"] . "</td>";

        echo "<td>" . htmlspecialchars($row["requester_ip"]) . "</td>";

        echo "<td>" . htmlspecialchars($row["content_title"]) . "</td>";

        echo "<td>" . htmlspecialchars($row["category_requested"]) . "</td>";

        echo "<td>" . htmlspecialchars($row["message"]) . "</td>";

        echo "<td id='status-" . $row["id"] . "'>" . $row["status"] . "</td>";

        echo "<td>" . $row["created_at"] . "</td>";


        echo "<td>";

        echo "<a href='../controllers/updateStatus_task3.php?id=" . $row["id"] . "&status=fulfilled'> Fulfilled </a>";

        echo "<br><br>";

        echo "<a href='../controllers/updateStatus_task3.php?id=" . $row["id"] . "&status=rejected'> Rejected </a>";

        echo "</td>";


        echo "</tr>";

    }

}
else
{

    echo "<tr>";

    echo "<td colspan='8'>No content requests found</td>";

    echo "</tr>";

}

?>

</table>

</body>

</html>