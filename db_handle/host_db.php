<?php
require_once(__DIR__ ."/../pdo/connection.php");
require_once(__DIR__ ."/generate_data.php");
require_once(__DIR__. "/../install/vendor/autoload.php");

if (isset($_POST['db']) || isset($_POST['table']) || isset($_POST['count']) || isset($_POST['times'])){
    $db = $_POST['db'];
    $table = $_POST['table'];
    $count = $_POST['count'];
    $times = $_POST['times'];

    if (!dbExists($pdo, $db)) {
        $sql = "DROP DATABASE $db";
        $pdo->exec($sql);
    }
    $sql = "CREATE DATABASE $db";
    $pdo->exec($sql);
    $pdo->exec("USE $db");

    operateTable($pdo, $table, $count, tableExists($pdo, $table));
    dataInsert($pdo, $table, $count, $times);
    header('Location:../index.php?table_success');
} else {
    // header('Location:../index.php?table_failed');
    echo 'failed';
}

/* Functions */
function dbExists($pdo, $db)
{
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