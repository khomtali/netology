<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    $pdo = new PDO('mysql:host=localhost;dbname=global;charset=utf8', 'ngubanova', 'neto1823');

    function booksFilter($pdo, $isbn, $name, $author)
    {
        $sql = 'SELECT * FROM books WHERE isbn LIKE :isbn AND name LIKE :name AND author LIKE :author';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['isbn' => "%$isbn%", 'name' => "%$name%", 'author' => "%$author%"]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    $isbn = !empty($_GET['isbn']) ? $_GET['isbn'] : '';
    $name = !empty($_GET['name']) ? $_GET['name'] : '';
    $author = !empty($_GET['author']) ? $_GET['author'] : '';
    $filtered = booksFilter($pdo, $isbn, $name, $author);
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
                foreach($filtered as $row): ?>
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
