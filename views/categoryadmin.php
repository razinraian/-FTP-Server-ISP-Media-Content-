<?php
include "../controllers/categoryadmin.php";
?>

<!DOCTYPE html>
<html>

<head>

    <title>Category</title>

    <link rel="stylesheet"
          href="../CSS/styleadmin.css">

</head>

<body>

<div class="container">

    <h2>
        <?php echo $categoryName; ?>
    </h2>


    <h3>Subcategories</h3>

    <?php

    if (count($subcategories) > 0)
    {
        foreach ($subcategories as $sub)
        {
            echo "<a class='category-link'
            href='categoryadmin.php?id=" .
            $sub["id"] .
            "'>" .
            $sub["name"] .
            "</a>";
        }
    }
    else
    {
        echo "<p>No subcategories</p>";
    }

    ?>


    <h3>Contents</h3>

    <?php

    if (count($contents) > 0)
    {
        foreach ($contents as $content)
        {
            echo "<div class='content-card'>";

            echo "<h3>" .
                 $content["title"] .
                 "</h3>";

            echo "<p>" .
                 $content["description"] .
                 "</p>";

            echo "<p>Category: " .
                 $content["category_name"] .
                 "</p>";

            echo "<p>Downloads: " .
                 $content["download_count"] .
                 "</p>";

            echo "<a href='../public/" .
                 $content["file_path"] .
                 "' download>
                 Download
                 </a>";

            echo "</div>";
        }
    }
    else
    {
        echo "<p>No contents found</p>";
    }

    ?>


    <br>

    <a href="indexadmin.php">
        Back to Home
    </a>

</div>

</body>
</html>