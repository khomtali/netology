<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    $user = 'ngubanova';
    $pass = 'neto1823';
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=ngubanova;charset=utf8', $user, $pass);
    } catch (PDOException $e) {
        print "Error: $e->getMessage()<br>";
        die;
    }

    function createTable($pdo, $tableName)
    {
        $sql = "CREATE TABLE $tableName (
            id INT NOT NULL AUTO_INCREMENT,
            name VARCHAR(50) NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    function showTables($pdo)
    {
        $sql = 'SHOW TABLES';
        $stmt = $pdo->prepare($sql);
        if($stmt->execute()) {
            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tables;
        }
        return false;
    }

    function describeTable($pdo, $tableName)
    {
        $sql = "DESCRIBE $tableName";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute()) {
            $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $options;
        }
        return false;
    }

    function deleteTable($pdo, $tableName)
    {
        $sql = "DROP TABLE IF EXISTS $tableName";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    function renameTable($pdo, $tableName, $newTableName)
    {
        $sql = "ALTER TABLE $tableName RENAME $newTableName";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }
?>
