<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=mysql", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed' .$e->getMessage();
    die();
}