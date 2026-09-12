<?php

include "../controllers/validation_task3.php";

?>

<!DOCTYPE html>

<html>

<head>

<title>FTP Server - Moderator</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div id="main-container">

<div id="form-container">

    <h1>Content Submission</h1>

    <form action="" method="POST"
          enctype="multipart/form-data"
          onsubmit="return validateForm()">

        <label>Title</label>

        <input type="text"
               id="title"
               name="title">

        <p id="titleerr" class="error"></p>

        <?php echo $titleErr; ?>


        <label>Description</label>

        <textarea id="description"
                  name="description"
                  rows="6"></textarea>

        <p id="descriptionerr" class="error"></p>

        <?php echo $descriptionErr; ?>


        <label>Category</label>

        <select id="category" name="category">

            <option value="">
                Select Category
            </option>

            <?php foreach ($categories as $cat) { ?>
                <option value="<?php echo $cat['id']; ?>">
                    <?php echo htmlspecialchars($cat['name']); ?>
                </option>
            <?php } ?>

        </select>

        <p id="categoryerr" class="error"></p>

        <?php echo $categoryErr; ?>


        <label>Upload Content File</label>

        <input type="file"
               id="cfile"
               name="file">

        <p id="fileerr" class="error"></p>

        <?php echo $fileErr; ?>


        <div class="buttons">

            <input type="submit"
                   name="mysubmit"
                   value="Submit"
                   class="submit-btn">

            <input type="reset"
                   value="Clear"
                   class="clear-btn">

        </div>

        <p id="successMessage"></p>

        <?php echo $successMsg; ?>

    </form>


    <div class="moderator-buttons">

        <a href="requestview.php">
            <button type="button">
                Content Requests
            </button>
        </a>

        <a href="../controllers/logout.php">
            <button type="button">
                Logout
            </button>
        </a>

    </div>

</div>


<div id="content-list">

    <h1>Available Contents</h1>

    <p id="deleteMessage"></p>

    <table border="1">

        <tr>

            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>File</th>
            <th>Category</th>
            <th>Uploader</th>
            <th>Action</th>

        </tr>


        <?php

        if (count($allContents) > 0)
        {
            foreach ($allContents as $row)
            {
                echo "<tr id='content-row-" . $row["id"] . "'>";

                echo "<td>" . $row["id"] . "</td>";

                echo "<td>" . htmlspecialchars($row["title"]) . "</td>";

                echo "<td>" . htmlspecialchars($row["description"]) . "</td>";

                echo "<td>" . htmlspecialchars($row["file_path"]) . "</td>";

                echo "<td>" . htmlspecialchars($row["category_name"]) . "</td>";

                echo "<td>" . htmlspecialchars($row["uploader_name"]) . "</td>";

                echo "<td>";

                echo "<button onclick='deleteContent(" .
                     $row["id"] .
                     ", this)'>Delete</button>";

                echo "</td>";

                echo "</tr>";
            }
        }
        else
        {
            echo "<tr>";
            echo "<td colspan='7'>No content found</td>";
            echo "</tr>";
        }

        ?>

    </table>

</div>

</div>

<script src="../js/validation.js"></script>

<script src="../js/ajax.js"></script>

</body>

</html>