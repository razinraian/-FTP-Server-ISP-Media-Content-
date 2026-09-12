<?php
include "../controllers/contentformvalidation.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Content</title>
    <link rel="stylesheet" href="../css/style.css">
     <script src="../js/no_cache_reload.js"></script>
</head>
<body>

<h1>Add Content</h1>

<form action="" method="POST" enctype="multipart/form-data">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?php echo $title; ?>">
    <span style="color:red;"><?php echo $titleErr; ?></span><br><br>

    <label>Description:</label><br>
    <textarea name="description"><?php echo $description; ?></textarea><br><br>

    <label>Category:</label><br>
    <select name="category_id">
        <option value="">Select Category</option>
        <?php foreach ($categories as $cat) { ?>
            <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
        <?php } ?>
    </select>
    <span style="color:red;"><?php echo $categoryErr; ?></span><br><br>

    <label>File:</label><br>
    <input type="file" name="content_file"><br><br>

    <input type="submit" name="mysubmit" value="Add Content">
    <input type="reset" value="Clear">
</form>

<p style="color:green;"><?php echo $successMsg; ?></p>

</body>
</html>