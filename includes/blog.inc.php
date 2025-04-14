<?php
    include_once "config.session.inc.php";
    include_once "autoloader.inc.php";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["user_id"])) {
   
    if (isset($_POST["publish"])) {
        $title = $_POST["title"];
        $body = $_POST["body"];
        $topic = $_POST["topic"];
        $cover_image = $_FILES["cover-image"];
        $blog = new blogContr($title, $body, $topic, $cover_image, $_SESSION["user_id"]);
        $blog->publishBlog();
    }
    elseif (isset($_POST["modify"])){
        $title_edit = $_POST["title_edit"];
        $body_edit = $_POST["body_edit"];
        $topic_edit = $_POST["topic_edit"];
        $cover_image_edit = $_FILES["cover-image_edit"];
        $edit = new blogContr($title_edit, $body_edit, $topic_edit, $cover_image_edit, $_SESSION["user_id"]);
        $edit->set_postid($_SESSION["post_postid"]);
        $edit->editBlog();
        // var_dump($_SESSION);
        // echo "\n";
        // var_dump($_POST);
    }
    elseif(isset($_POST["delete"])){
        $postid = $_POST["postid"];
        $delete = new blogContr();
        $delete->set_postid($_POST["postid"]);
        $delete->delete_blog();  
    }
    // for more advanced newsletter logic
    // elseif (isset($_POST["subscribe"])) {
    //     $username = $_POST["username"];
    //     $email= $_POST["email"];    
    //     $subs = new blogContr();
    //     $subs->subscribe($username,$email);
        
    // }
    
   
} 
else {

    header('location:../index.php');
    die();
}
