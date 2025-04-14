<?php
include_once "config.session.inc.php";
include_once "autoloader.inc.php";
if (isset($_POST["signup"])) {
    //grabbing data
    $username = $_POST["username"];
    $pwd = $_POST["password"];
    $pwd_confirm = $_POST["password_confirm"];
    $email= $_POST["email"];
    include_once "autoloader.inc.php";

    //

    $signup = new SignupContr($username, $pwd, $pwd_confirm, $email);
    $signup->signupUser();



}
else {
    header('location:../index.php');
    die();
}