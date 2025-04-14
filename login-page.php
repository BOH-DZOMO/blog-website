<?php
include_once "includes/config.session.inc.php";
include_once "includes/autoloader.inc.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <div class="login-form">
        <section><form action="includes/login.inc.php" method="post">
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="pwd">Password</label><br>
            <input type="text" name="password" id="password" name="password"><br>
            <button type="submit" name="login" class="button">Login</button><br>
            <p>If you do not have an account, <a href="signup-page.php"><i>create one</i></a></p>
        </form></section>
        <section>
        <?php
        $login_view = new LoginView();
        $login_view->check_login_errors();
        ?>
        </section>
        </div>
    </main>
</body>

</html>