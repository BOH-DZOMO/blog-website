<?php
declare(strict_types = 1);
class Signup extends Dbh
{
    protected function userExists(string $username)
    {
        $query = "SELECT username FROM users WHERE username = :username";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    protected function emailExists(string $email)
    {
        $query = "SELECT email FROM `users` WHERE email = :email";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;

    }

    protected function register_user(string $email, string $username, string $password){
        $query = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        $stmt = $this->connect()->prepare($query);
        $options = [
               'cost' => 12
        ];
        $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashedPwd);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $stmt= null;
 }
}
