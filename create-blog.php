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
    ?>

    <div class="blog-container">
        <?php

        ?>      
        <h3>Create Post</h3>
        <div class="blog-content">
            <form action="includes/blog.inc.php" method="post" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" aria-label="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <textarea class="form-control" id="body" rows="5" name="body"></textarea>
                </div>
                <div class="mb-3">
                    <label for="topic" class="form-label">Topic</label>
                    <select class="form-select form-select-lg" aria-label="topic" name="topic">
                        <?php
                        $view->output_topics();
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cover-image" class="form-label">Input Image</label>
                    <input class="form-control" type="file" id="cover-image" name="cover-image"  accept=".jpg, .jpeg, .png, .gif">
                </div>
                <button type="submit" class="btn btn-success" name="publish">Publish</button>
            </form>
        </div>
        <?php
        ?>
    </div>

</body>

</html>