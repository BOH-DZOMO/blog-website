<?php
include_once "config.session.inc.php";
include_once "autoloader.inc.php";
if (isset($_POST["login"])) {
    //grabbing data
    $username = $_POST["username"];
    $pwd = $_POST["password"];
    

    //
    $login = new LoginContr($username, $pwd);
    $login->loginUser();
    



}
else {
    header('location:../index.php');
    die();
}