<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
include "../models/UserModel.php";
include "../models/ContentModel.php";

$userModel = new UserModel();
$contentModel = new ContentModel();

$allUsers = $userModel->getAllUsers();
$allContents = $contentModel->getAllContents();

$totalUsers = count($allUsers);
$totalContents = count($allContents);
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

<div class="container">
    <div class="welcome-banner">
        <div class="banner-header-flex">
            <div>
                <h1>Welcome, Admin</h1>
                <p>Manage moderators, content, and monitor your platform from here.</p>
            </div>
            <a href="../controllers/logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="dashboard-box">
        <h2>Overview</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number"><?php echo $totalUsers; ?></span>
                <span class="stat-label">Total Moderators/Admins</span>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo $totalContents; ?></span>
                <span class="stat-label">Total Contents</span>
            </div>
        </div>

        <h2>Manage Moderators</h2>
        <ul>
            <li><a href="adminform.php">Add New Moderator</a></li>
            <li><a href="managemoderators.php">View / Delete Moderators</a></li>
        </ul>

        <h2>Manage Contents</h2>
        <ul>
            <li><a href="contentform.php">Add New Content</a></li>
            <li><a href="managecontents.php">View / Edit / Delete Contents</a></li>
        </ul>
    </div>
</div>

</body>
</html>