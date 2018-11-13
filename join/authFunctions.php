<?php
  require_once 'connection.php';
  session_start();

  function getUsers()
  {
    $pdo = connect();
    $sqlQuery = 'SELECT id, login, password FROM user';
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  function register($login, $password)
  {
    $pdo = connect();
    $sqlQuery = 'INSERT INTO user(login, password) VALUES (?, ?)';
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute([$login, $password]);
    return true;
  }

  function userExistence($login)
  {
    $pdo = connect();
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
        $_SESSION['user'] = $user['login'];
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

  function isAuthorized()
  {
    return (getAuthorizedUser() !== null);
  }

  function logOut()
  {
    session_destroy();
    header('Location: ./authorization.php');
  }
?>
