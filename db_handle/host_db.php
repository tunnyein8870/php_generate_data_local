<?php
require_once("../pdo/connection.php");
require_once('generate_data.php');
require '../install/vendor/autoload.php';

try {
   
} catch (Exception $e) {
    echo 'Install Composer and Faker first.' . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $db = $_POST['db'];
    $table = $_POST['table'];
    $count = $_POST['count'];
    $times = $_POST['times'];
    echo 'number of times' . $times;

    if (!dbExists($pdo, $db)) {
        $sql = "DROP DATABASE $db";
        $pdo->exec($sql);
        echo "<br>database deleted.<br>";
    }
    $sql = "CREATE DATABASE $db";
    $pdo->exec($sql);
    $pdo->exec("USE $db");

    echo "<br> $db Connected <br>";
    // operateTable to create or alter table.
    operateTable($pdo, $table, $count, tableExists($pdo, $table));
    dataInsert($pdo, $table, $count, $times);
    header('Location:../index.php?table_success');
} else {
    header('Location:../index.php?table_failed');
}

/* Functions */
function dbExists($pdo, $db)
{
    // check database exists
    echo $db;
    $checkDbQuery = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?";
    try {
        $stmt = $pdo->prepare($checkDbQuery);
        $stmt->execute([$db]);
        return $stmt->rowCount() == 0;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>