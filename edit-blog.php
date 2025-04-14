<?php
include_once "includes/config.session.inc.php";
include_once "includes/autoloader.inc.php";
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create blog</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.css">
<script src="./bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</head>

<body>
    <?php include_once "header.php";
    $view = new blogView();
    if (isset($_POST['postid'])) {
        $_SESSION["post_postid"] = $_POST["postid"];
        // if (empty($_SESSION["post_postid"])) {
        //     $_SESSION["post_postid"] = $_POST["postid"];
        // }
    }
    ?>

    <div class="blog-container">
        <?php
        if (isset($_SESSION["post_postid"])) {
            echo "<h3>Edit Post</h3>";
            $view->output_editForm($_SESSION["post_postid"]);
        }
        ?>
    </div>

</body>

</html>