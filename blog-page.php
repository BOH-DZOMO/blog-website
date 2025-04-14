<?php
include_once "includes/config.session.inc.php";
include_once "includes/autoloader.inc.php";
$view = new blogView;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>"Title</title>
    <link rel="stylesheet" href="blog-page.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.css">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</head>

<body>
    <?php include_once "header.php" ;
    ?>
    <!-- <header>
        <div class="head-container">
            <div>BLOGGER</div>
            <div>Search</div>
            <div>notification</div>
            <div>
                <form action="includes/newsletter.inc.php" method="post">
                    <button type="submit" class="">newsletter</button>
                </form>
            </div>
            <div>
                <form action="includes/login.inc.php" method="post">
                    <button type="submit" class="">Login</button>
                </form>
            </div>
            <div>username</div>
        </div>

    </header> -->
    <main>
        <article>
            <div class="content">
                <?php
                if (isset($_SESSION["user_id"]) and blogView::find_userid($_GET['post'])=== $_SESSION["user_id"]) {
                ?>
                <!-- and $_SESSION["user_username"] === -->
                <div class="dashboard mb-3">
                    <div>like</div>
                    <div><form action="edit-blog.php" method="post">
                        <input type="hidden" name="postid" value="<?php echo $_GET['post'];?>">
                    <button type="submit" class="btn btn-info">Edit</button>
                    </form>
                </div>
                    <div><form action="includes/blog.inc.php" method="post">
                        <input type="hidden" name="postid" value="<?php echo $_GET['post'];?>">
                    <button type="submit" class="btn btn-danger" name="delete">delete</button>
                    </form></div>
                    <div>follow</div>
                </div>
                <?php
                }
                ?>
                <?php if (isset($_GET["post"])) {
                    $view->output_fullblog($_GET['post']);
                }
                else {
                    echo "<p>The blog was not found...., Try again and make sure you are logined</p>";
                }
                ?>

            </div>
        </article>
    </main>
</body>

</html>