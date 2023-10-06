<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once(__DIR__ . "/generate_data.php");
require_once(__DIR__ . "/../install/vendor/autoload.php");
$success = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $host = isset($_POST['host']) ? $_POST['host'] : null;
    $user = isset($_POST['user']) ? $_POST['user'] : null;
    $pass = isset($_POST['pass']) ? $_POST['pass'] : null;
    echo "<script>alert($host, '$user', '$pass')</script>";
    $success = true;
} else {
    echo "No POST request received.";
    $success = false;
}
if ($success) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=mysql", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        die();
    }

    if (isset($_POST['db']) || isset($_POST['table']) || isset($_POST['count']) || isset($_POST['times'])) {
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

        $grantdb = "GRANT ALL PRIVILEGES ON $db.* TO '$user'@'%' IDENTIFIED BY '$pass';";
        $pdo->exec($grantdb);

        operateTable($pdo, $table, $count, tableExists($pdo, $table));
        dataInsert($pdo, $table, $count, $times);
        echo "<script>alert('Table $table created.')</script>";
        header('Location:../index.php?table_success');
    } else {
        header('Location:../index.php?table_failed');
        echo 'failed';
    }
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
