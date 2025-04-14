<?php
include_once "includes/config.session.inc.php";
include_once "includes/autoloader.inc.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <div class="login-form">
            <section>
                <form action="includes/signup.inc.php" method="post">
                    <input type="text" name="username" id="" placeholder="username" value=""><br>
                    <input type="password" name="password" id="" placeholder="password"><br>
                    <input type="password" name="password_confirm" id="" placeholder="repeat password"><br>
                    <input type="email" name="email" id="" placeholder="E-mail" value=""><br>
                    <button type="submit" name="signup" class="button">SignUp</button><br>
                </form>
            </section>
            <section>
                <?php
                $signup_view = new SignupView();
                $signup_view->check_signup_errors();
                ?>
            </section>
        </div>
    </main>
</body>

</html>