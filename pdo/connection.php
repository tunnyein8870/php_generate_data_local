<?php

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $host = $_POST['host'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $pdo = new PDO("mysql:host=$host;dbname=mysql", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
} catch (PDOException $e) {
    echo 'Connection failed' . $e->getMessage();
    die();
}