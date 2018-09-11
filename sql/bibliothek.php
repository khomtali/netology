<?php
    $pdo = new PDO("mysql:host=localhost;dbname=global;charset=utf8", "ngubanova", "neto1823");
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Библиотека</title>
        <style>
            table {
                border-spacing: 0;
                border-collapse: collapse;
            }
            table td, table th {
                border: 1px solid #ccc;
                padding: 5px;
            }
            table th {
                background: #eee;
            }
        </style>
    </head>
    <body>
        <h1>Библиотека успешного человека</h1>
        <form method="GET">
            <input type="text" name="isbn" placeholder="ISBN" value="<?php if(!empty($_GET['isbn'])) echo $_GET['isbn']; ?>">
            <input type="text" name="name" placeholder="Название книги" value="<?php if(!empty($_GET['name'])) echo $_GET['name']; ?>">
            <input type="text" name="author" placeholder="Автор книги" value="<?php if(!empty($_GET['author'])) echo $_GET['author']; ?>">
            <input type="submit" value="Поиск">
        </form>
        <table>
            <tr>
                <th>Название</th>
                <th>Автор</th>
                <th>Год выпуска</th>
                <th>Жанр</th>
                <th>ISBN</th>
            </tr>
            <?php
                if(!empty($_GET["isbn"]) || !empty($_GET["name"]) || !empty($_GET["author"])) {
                    $isbn = "%".$_GET["isbn"]."%";
                    $name = "%".$_GET["name"]."%";
                    $author = "%".$_GET["author"]."%";
                    $sql = "SELECT * FROM books WHERE isbn LIKE :isbn AND name LIKE :name AND author LIKE :author";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(["isbn" => $isbn, "name" => $name, "author" => $author]);
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $sth = $pdo->prepare("SELECT * FROM books");
                    $sth->execute();
                    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                }
                foreach($result as $row): ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['author'] ?></td>
                    <td><?php echo $row['year'] ?></td>
                    <td><?php echo $row['genre'] ?></td>
                    <td><?php echo $row['isbn'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
