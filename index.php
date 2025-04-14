<?php
include_once "includes/config.session.inc.php";
include_once "includes/autoloader.inc.php";
$view = new blogView();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogger</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include_once "header.php"?>
    <main>
        <article>
            <div class="content">
                <section class="blog-post">
                    <figure>
                        <img src="./Welcome Scan.jpg" alt="image" style="width:100%">
                        <figcaption>"Topic"</figcaption>
                    </figure>
                    <div class="blog-body">
                        <h3><a href="blog-page.php">"Title</a></h3>
                        <p class="preview">"preview</p>
                        <p><span>Author</span> - <span>Date</span></p>
                    </div>
                </section>
                <?php
                $view->output_blogs();
                ?>
            </div>
            <aside>
                <div>Topics</div>
            </aside>
        </article>
        <?php
        var_dump($_SESSION);
        // var_dump($view->get_blogs()); 
        ?>

    </main>
</body>

</html>