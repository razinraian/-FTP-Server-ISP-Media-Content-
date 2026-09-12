<?php
include "../models/UserModel.php";

$userModel = new UserModel();
$allUsers = $userModel->getAllUsers();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Moderators</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/delete_moderator.js"></script>
</head>
<body>

<div class="container">
    <div class="page-header">
        <h1>Manage Moderators</h1>
        <a href="adminform.php" class="btn-add-new">+ Add New Moderator</a>
    </div>

    <div class="moderator-table-wrap">
        <table class="moderator-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            <?php foreach ($allUsers as $user): ?>
            <tr id="row-<?php echo $user['id']; ?>">
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <span class="role-badge <?php echo htmlspecialchars($user['role']); ?>">
                        <?php echo htmlspecialchars($user['role']); ?>
                    </span>
                </td>
                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                <td>
                    <button class="btn-delete" onclick="deleteModerator(<?php echo $user['id']; ?>)">Delete</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

</body>
</html>