<?php

try {
    echo isset($_POST['host']);
    if (isset($_POST['host'])) {
        $host = $_POST['host'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $pdo = new PDO("mysql:host=$host;dbname=mysql", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    else{
        echo "Fill host, user or password.";
    }
} catch (PDOException $e) {
    echo 'Connection failed' . $e->getMessage();
    die();
}