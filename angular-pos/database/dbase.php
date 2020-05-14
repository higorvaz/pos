<?php
try {
    // first connect to database with the PDO object.
    $db_con = new \PDO("mysql:host=localhost;dbname=prefix;charset=utf8", "root", "", [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch(\PDOException $e){
    // if connection fails, show PDO error.
    echo "Error connecting to mysql: ". $e->getMessage();
}
?>