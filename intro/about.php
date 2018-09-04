// Introduction to PHP, Homework 1.1

<?php
    $name = 'Natalia';
    $age = 26;
    $email = 'khomtali@gmail.com';
    $city = 'Moscow';
    $about = 'web-developer';
?>

<!DOCTYPE>
<html lang="eng">
    <head>
        <title><?= "$name's page" ?></title>
        <meta charset="utf-8">
        <style>
            body {
                font-family: Helvetica, sans-serif;
            }
        </style>
    </head>
    <body>
        <h1>User page: <?= $name ?></h1>
        <dl>
            <dt>Name</dt>
            <dd><?= $name ?></dd>
            <dt>Age</dt>
            <dd><?= $age ?></dd>
            <dt>E-mail</dt>
            <dd><a href="mailto:<?= $email ?>"><?= $email ?></a></dd>
            <dt>City</dt>
            <dd><?= $city ?></dd>
            <dt>About</dt>
            <dd><?= $about ?></dd>
        </dl>
    </body>
</html>
