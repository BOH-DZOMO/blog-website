<?php
include_once "includes/config.session.inc.php";
include_once "includes/autoloader.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.css">
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</head>

<body>
    <?php include_once "header.php" ?>
    <main class="container-lg">

        <div class="card d-flex justify-content-center align-items-center bg-info-subtle" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Newsletter</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                <p class="card-text">Stay up to date with the latest news and blogs</p>
                <form action="includes/sendmail.inc.php"  method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input class="form-control form-control-lg" type="text" placeholder="Enter your name here" aria-label="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control form-control-lg" type="email" placeholder="Enter your email here" aria-label="email" name="email">
                </div>
                <button type="submit" class="btn btn-success" name="subscribe">Subscribe</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>