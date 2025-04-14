<?php
class LoginContr extends Login{
    private $username;
    private $pwd;
    private $loginErrors = [];
    
    public function __construct($username, $pwd)
    {
        $this->username = $username;
        $this->pwd = $pwd;
    }
    public function getProp(){
        return array(
            'username' => $this->username,
            'password' => $this->pwd
        );
    }
    
    private function emptyInput(){
        if(empty($this->username) || empty($this->pwd)){
            return true;
        }
        else {
            return false;
        }
    }
   public function loginUser(){
        if ($this->emptyInput()) {
            $this->loginErrors["empty_input"] = "Fill in all fields!";
        }
        if ($this->get_userPassword($this->username) == false) {
            $this->loginErrors["invalid_username"] = "invalid username--";
        }
        elseif (!password_verify($this->pwd, $this->get_userPassword($this->username)["password"]))
        {
            $this->loginErrors["invalid_password"] = "invalid password--";
        }   

        if ($this->loginErrors){
            $_SESSION["errors_login"] = $this->loginErrors;
            header("location: ../login-page.php");

            exit();
        }

        
        $result = $this->get_userData($this->username);
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        header("location: ../index.php?login=success");
        exit();

   }

}

