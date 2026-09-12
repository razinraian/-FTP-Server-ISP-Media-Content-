<?php

session_start();

include "../models/db_connection.php";

$conn = getConnection();


/* Get Categories */

$categories = array();

$result = $conn->query(
    "SELECT id, name
     FROM categories
     WHERE parent_id IS NULL
     OR parent_id = 0
     ORDER BY name"
);

while ($row = $result->fetch_assoc())
{
    $categories[] = $row;
}


/* Get Highlighted Contents */

$contents = array();

$result = $conn->query(
    "SELECT c.id,
            c.title,
            c.description,
            c.file_path,
            c.download_count,
            cat.name AS category_name
     FROM contents c
     JOIN categories cat
     ON c.category_id = cat.id
     ORDER BY c.download_count DESC,
              c.uploaded_at DESC
     LIMIT 6"
);

while ($row = $result->fetch_assoc())
{
    $contents[] = $row;
}

$conn->close();

?>

<!DOCTYPE html>
<html>

<head>

    <title>FTP Server Home</title>

    <link rel="stylesheet"
          href="../css/styleadmin.css">

</head>

<body>

<nav>

    <div class="nav-title">
        FTP Server
    </div>

    <div class="nav-links">

        <a href="indexadmin.php">
            Home
        </a>

        <?php

        if (isset($_SESSION["user_id"]))
        {

            echo "<a href='profileadmin.php'>
                  Profile
                  </a>";

            echo "<a href='../controllers/logout.php'>
                  Logout
                  </a>";

            if ($_SESSION["role"] == "admin")
            {
                echo "<a href='../views/admindashboard.php'>
                      Admin Dashboard
                      </a>";
            }

            if ($_SESSION["role"] == "moderator")
            {
                echo "<a href='contentsubmission.php'>
                      Moderator Dashboard
                      </a>";
            }

        }
        else
        {

            echo "<a href='loginadmin.php'>
                  Login
                  </a>";

            echo "<a href='registeradmin.php'>
                  Register
                  </a>";

        }

        ?>

    </div>

</nav>


<div class="container">

    <h1>FTP Server</h1>

    <h2>Categories</h2>


    <div class="category-container">

        <?php

        foreach ($categories as $category)
        {
            echo "<div class='category-card'>";

            echo "<a href='categoryadmin.php?id=" .
                 $category["id"] .
                 "'>";

            echo htmlspecialchars($category["name"]);

            echo "</a>";

            echo "</div>";
        }

        ?>

    </div>


    <h2>Highlighted Contents</h2>


    <div class="content-container">

        <?php

        foreach ($contents as $content)
        {
            echo "<div class='content-card'>";

            echo "<h3>" .
                 htmlspecialchars($content["title"]) .
                 "</h3>";

            echo "<p>" .
                 htmlspecialchars($content["description"]) .
                 "</p>";

            echo "<p>Category: " .
                 htmlspecialchars($content["category_name"]) .
                 "</p>";

            echo "<p>Downloads: " .
                 $content["download_count"] .
                 "</p>";

            echo "<a href='../public/" .
                 htmlspecialchars($content["file_path"]) .
                 "' download>
                 Download
                 </a>";

            echo "</div>";
        }

        ?>

    </div>

</div>

</body>
</html>