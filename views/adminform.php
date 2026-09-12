<?php
include "../controllers/adminformvalidation.php";


$moderators = $userModel->getAllUsers();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/no_cache_reload.js"></script>
</head>
<body>

<h1>Add Moderator</h1>

<form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <label>Name:</label><br>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
    <span style="color:red;"><?php echo $nameErr; ?></span><br><br>

    <label>Email:</label><br>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>">
    <span style="color:red;"><?php echo $emailErr; ?></span><br><br>

    <label>Password:</label><br>
    <input type="password" id="password" name="password">
    <span style="color:red;"><?php echo $passwordErr; ?></span><br><br>

    <label>Confirm Password:</label><br>
    <input type="password" id="confirm_password" name="confirm_password">
    <span style="color:red;"><?php echo $confirmErr; ?></span><br><br>

    <label>Role:</label><br>
    <select id="role" name="role">
        <option value="">Select Role</option>
        <option value="moderator">Moderator</option>
        <option value="admin">Admin</option>
    </select>
    <span style="color:red;"><?php echo $roleErr; ?></span><br><br>

    <label>Profile Picture:</label><br>
    <input type="file" name="profile_picture" accept="image/*"><br><br>

    <input type="submit" name="mysubmit" value="Add User">
    <input type="reset" value="Clear">
</form>

<p style="color:green;"><?php echo $successMsg; ?></p>

<hr>
<h2>All Users</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Created At</th>
    </tr>
    <?php foreach ($moderators as $user): ?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['name']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['role']; ?></td>
        <td><?php echo $user['created_at']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>