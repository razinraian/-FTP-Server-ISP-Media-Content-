<?php
include "../controllers/editcontentvalidation.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Content</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h1>Edit Content</h1>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label>Title:</label><br>
    <input type="text" name="title" value="<?php echo $title; ?>">
    <span style="color:red;"><?php echo $titleErr; ?></span><br><br>

    <label>Description:</label><br>
    <textarea name="description"><?php echo $description; ?></textarea><br><br>

    <label>Category:</label><br>
    <select name="category_id">
        <?php foreach ($categories as $cat) { ?>
            <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $category_id) ? "selected" : ""; ?>>
                <?php echo $cat['name']; ?>
            </option>
        <?php } ?>
    </select>
    <span style="color:red;"><?php echo $categoryErr; ?></span><br><br>

    <label>Replace File (optional):</label><br>
    <input type="file" name="content_file"><br><br>

    <input type="submit" name="mysubmit" value="Update Content">
</form>

<p style="color:green;"><?php echo $successMsg; ?></p>

<a href="managecontents.php">Back to All Contents</a>

</body>
</html>