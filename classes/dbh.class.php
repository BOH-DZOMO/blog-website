<?php
class Dbh{
   protected function connect(){
    try {
        $dsn = "mysql:host=localhost;dbname=blog_application";
        $pdo = new PDO($dsn, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (PDOException $e) {
        
        echo $e->getCode() . "<br>";
        echo $e->getMessage() . "<br>";
        die();
    }
   }
}