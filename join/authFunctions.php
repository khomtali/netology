<?php
  session_start();
  function getUsers()
  {
    $pdo = new PDO('mysql:host=localhost;dbname=ngubanova;charset=utf8', 'ngubanova', 'neto1823');
    $sqlQuery = 'SELECT login, password FROM user';
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  function register($login, $password)
  {
    $pdo = new PDO('mysql:host=localhost;dbname=ngubanova;charset=utf8', 'ngubanova', 'neto1823');
    $sqlQuery = 'INSERT INTO user(login, password) VALUES (?, ?)';
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute([$login, $password]);
    return true;
  }

  function userExistence($login)
  {
    $pdo = new PDO('mysql:host=localhost;dbname=ngubanova;charset=utf8', 'ngubanova', 'neto1823');
    $sqlQuery = 'SELECT id FROM user WHERE login = ?';
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute([$login]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($result)) {
      return true;
    }
    return null;
  }

  function login($login, $password)
  {
    $users = getUsers();
    foreach($users as $user) {
      if($user['login'] === $login && $user['password'] === $password) {
        $_SESSION['user_id'] = $user['id'];
        return true;
      }
    }
    return false;
  }

  function getAuthorizedUser()
  {
    if (!isset($_SESSION['user_id'])) {
      return null;
    }
    return $_SESSION['user_id'];
  }

  function isAuth()
  {
    return (getAuthorizedUser() !== null);
  }

  function logout()
  {
    session_destroy();
    header('Location: ./authorization.php');
  }
?>
