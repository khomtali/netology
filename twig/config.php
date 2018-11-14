<?php
  function connect()
  {
    $host = 'localhost';
    $dbname = 'ngubanova';
    $user = 'ngubanova';
    $password = 'neto1823';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    return $pdo;
  }
?>
