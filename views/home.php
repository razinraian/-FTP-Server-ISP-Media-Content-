<?php
include "../controllers/home_control.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home - Browse Contents</title>
    <link rel="stylesheet" href="../css/task4_style_v2.css">
    <script src="../js/home.js"></script>
</head>
<body>

<div class="page-banner">
    <div class="page-banner-inner banner-flex">
        <div>
            <h1>ISP Media Content</h1>
            <p>Browse, search, and request movies, software, and more.</p>
        </div>
        <a href="loginadmin.php" class="login-btn">Login</a>
    </div>
</div>

<div class="container">

    <h2>Search</h2>
    <div class="search-wrap">
        <input type="text" id="searchBox" onkeyup="searchContents()" placeholder="Search by title or description">
    </div>

    <h2>Categories</h2>
    <div class="category-tabs">
        <a href="home.php" class="<?php echo ($selectedCategory == '') ? 'active' : ''; ?>">All</a>
        <?php foreach ($topCategories as $cat) { ?>
            <a href="home.php?category=<?php echo $cat['id']; ?>"
               class="<?php echo ($selectedCategory == $cat['id']) ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($cat['name']); ?>
            </a>
        <?php } ?>
    </div>

    <h2>Contents</h2>
    <div id="contentList">
        <?php if (count($contents) == 0) { ?>
            <p class="empty-state">No content found.</p>
        <?php } else { ?>
            <?php foreach ($contents as $content) { ?>
                <div class="content-item">
                    <span class="category-tag"><?php echo htmlspecialchars($content['category_name']); ?></span>
                    <h3><?php echo htmlspecialchars($content['title']); ?></h3>
                    <p><?php echo htmlspecialchars($content['description']); ?></p>
                    <p class="download-count">Downloads: <?php echo $content['download_count']; ?></p>
                    <a href="../controllers/download_control.php?id=<?php echo $content['id']; ?>">Download</a>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

    <h2>Can't Find What You're Looking For?</h2>
    <form action="" method="POST" id="requestForm" onsubmit="return validateRequestForm()">
        <div class="form-group">
            <label>Content Title</label>
            <input type="text" id="content_title" name="content_title" value="<?php echo $requestTitle; ?>">
            <span class="form-error"><?php echo $requestTitleErr; ?></span>
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category_requested">
                <option value="">Select Category</option>
                <?php foreach ($allCategories as $cat) { ?>
                    <option value="<?php echo $cat['name']; ?>"><?php echo $cat['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Message</label>
            <textarea name="message"><?php echo $requestMessage; ?></textarea>
        </div>

        <input type="submit" name="submit_request" value="Submit Request">
    </form>

    <?php if ($requestSuccessMsg != "") { ?>
        <p class="alert-success"><?php echo $requestSuccessMsg; ?></p>
    <?php } ?>

</div>

</body>
</html>