<?php
include "../models/ContentModel.php";
$contentModel = new ContentModel();
$contents = $contentModel->getAllContents();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Contents</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <div class="page-header">
        <h1>Manage Contents</h1>
        <a href="contentform.php" class="btn-add-new">+ Add New Content</a>
    </div>

    <div class="moderator-table-wrap">
        <table class="moderator-table">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Uploader</th>
                <th>Uploaded At</th>
                <th>Action</th>
            </tr>
            <?php foreach ($contents as $row) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                <td><?php echo htmlspecialchars($row['uploader_name']); ?> (<?php echo htmlspecialchars($row['uploader_role']); ?>)</td>
                <td><?php echo $row['uploaded_at']; ?></td>
                <td>
                    <a href="editcontent.php?id=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="../controllers/deletecontent.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>