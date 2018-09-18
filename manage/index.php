<?php
    require_once 'functions.php';
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>DataBase NGubanova</title>
    </head>
    <body>
        <h1>Create table</h1>
        <form method="POST">
            <input type="text" name="tableName" placeholder="Name">
            <input type="submit" name="create" value="Create">
        </form>
        <?php if(!empty($_POST['tableName'])):
            $tableName = $_POST['tableName'];
            createTable($pdo, $tableName);
            echo "Table $tableName was created!<br>";
        endif; ?>
        <form method="POST">
            <input type="hidden" name="list" value="true">
            <input type="submit" value="Show all tables">
        </form>
        <?php if(!empty($_POST['list'])): ?>
            <?php $tables = showTables($pdo); ?>
            <ul>
            <?php foreach($tables as $table):
                echo '<li><form method="POST">
                <input type="hidden" name="describe" value="'.$table['Tables_in_'.$user].'">
                <input type="submit" value="'.$table['Tables_in_'.$user].'">
                </form></li>';
            endforeach; ?>
            </ul>
            <?php if(!empty($_POST['describe'])):
                $tableName = $_POST['describe'];
                var_dump($tableName);
                $options = describeTable($pdo, $tableName);
                var_dump($options);
            endif;
        endif; ?>
    </body>
</html>
