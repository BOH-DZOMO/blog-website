<?php


class SignupContr extends Signup{
    private $username;
    private $pwd;
    private $pwd_confirm;
    private $email;
    private $signupErrors = [];
    
    public function __construct($username, $pwd, $pwd_confirm, $email)
    {
        $this->username = $username;
        $this->pwd = $pwd;
        $this->pwd_confirm = $pwd_confirm;
        $this->email = $email;
        
        
    }
public function signupUser(){

    if ($this->emptyInput() == true) {
        $this->signupErrors["empty_input"] = "Fill in all fields!";
    }
    if ($this->emailExists($this->email) === 1) {
        $this->signupErrors["email_used"] = " email already taken!";
    }
    if ($this->userExists($this->username)) {
        $this->signupErrors["username_taken"] = "username already taken!";
    }
    if ($this->pwdMatch() == false) {
        $this->signupErrors["password_mismatch"] = "password mismatch";
    }
    if ($this->is_email_invalid() == true) {
        $this->signupErrors["invalid_email"] = "Invalid email used!";
    }


    if ($this->signupErrors){
        $_SESSION["errors_signup"] = $this->signupErrors();
        header("location: ../signup-page.php");
        exit();
    }

     $this->register_user( $this->email,  $this->username, $this->pwd);
    header("location: ../login-page.php?signup=success");
}
    public function signupErrors(){
        return $this->signupErrors;
    }

    public function getProp(){
        return array(
            'username' => $this->username,
            'email' => $this->email,
            'pwd' => $this->pwd,
            'pwd-con' => $this->pwd_confirm,
        );
    }
    
    private function emptyInput(){
        if(empty($this->username) || empty($this->email) || empty($this->pwd) || empty($this->pwd_confirm)){
            return true;
        }
        else {
            return false;
        }
    }
    private function is_email_invalid(){
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else{
            return false;
        }
    }
    private function pwdMatch(){
        if ($this->pwd == $this->pwd_confirm) {
            return true;
        }else {
            return false;
        }
    }
    // public function UserInfoCheck(){
    //     if ($this->userExists($this->username)) {
    //         return true;
    //     }
    //     else {
    //         return false;
    //     }
    // }
}