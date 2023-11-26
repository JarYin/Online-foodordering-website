<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "grabfood_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name;", $username, $password);
} catch (PDOException $e) {
    echo "Failed connect to database" . $e->getMessage();
}