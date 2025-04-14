<?php
Class Login extends Dbh{
    protected function get_userPassword(string $username) {
        $query = "SELECT password FROM users WHERE username = :username";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
    
        if ($stmt->rowCount() == 1) {
           return $stmt->fetch();
        }
        else {
            return false;
        }
    }
    protected function get_userData(string $username) {
        $query = "SELECT username, id FROM users WHERE username = :username";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();   
        $result = $stmt->fetch();
        return $result;
    }

}