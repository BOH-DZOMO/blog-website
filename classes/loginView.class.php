<?php
class LoginView extends Login{
    public function check_login_errors(){
        if (isset($_SESSION["errors_login"])) {
            $errors = $_SESSION["errors_login"];
            echo "<br>";
            foreach ($errors as $error) {
                echo "<p class='form-error'>$error</p>";
            }
    
    
            unset($_SESSION["errors_login"]); 
        }
        else if (isset($_GET["login"]) && $_GET["login"] === "success") {
            echo '<br>';
            echo "<p class='signup-success'>Signup Success!</p>";
        }
    }
    public function output_username()
    {
        if (isset($_SESSION['user_id'])){
            echo "You are logged in as " . $_SESSION['user_username'] . ".";
        }
        else{
            echo "You are not logged in.";
        }
    
    }
}