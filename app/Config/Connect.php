<?php

class Connect{
    public static function Conn(){
        $conn = new PDO("mysql: host=localhost; dbname=webdeck; charset=utf8", "root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $conn;
    }
}


?>