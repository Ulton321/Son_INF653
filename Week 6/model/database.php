<?php
$dsn = "mysql:host=localhost; dbname=assignment_tracker";
$username = 'root';


try {
    $db = new PDO($dsn, $username);
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("Database connection is failed");
}
