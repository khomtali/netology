<?php

  function addTask()
  {
    $pdo = new PDO('mysql:host=localhost;dbname=ngubanova;charset=utf8', 'ngubanova', 'neto1823');
    $id = $_SESSION['user_id'];
    $sqlQuery = 'INSERT INTO task(user_id, assigned_user_id, description, date_added) VALUES (?, ?, ?, NOW())';
    $task = $_POST['task'];
    $stmt = $pdo->prepare($sqlQuery);
    return $stmt->execute([$id, $id, $task]);
  }

  function deleteTask()
  {
    $pdo = new PDO('mysql:host=localhost;dbname=ngubanova;charset=utf8', 'ngubanova', 'neto1823');
    $sqlQuery = 'DELETE FROM task WHERE user_id = ? AND id = ? LIMIT 1';
    $id = $_POST['deletedTask'];
    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare($sqlQuery);
    return $stmt->execute([$userId, $id]);
  }

  function changeStatus()
  {
    $pdo = new PDO('mysql:host=localhost;dbname=ngubanova;charset=utf8', 'ngubanova', 'neto1823');
    $id = $_POST['changedTask'];
    $userId = $_SESSION['user_id'];
    $task = getTaskById($id);
    if($task['is_done']) {
      $sqlQuery = 'UPDATE task SET is_done = 0 WHERE user_id = ? AND id = ? LIMIT 1';
    } else {
      $sqlQuery = 'UPDATE task SET is_done = 1 WHERE user_id = ? AND id = ? LIMIT 1';
    }
    $stmt = $pdo->prepare($sqlQuery);
    return $stmt->execute([$userId, $id]);
  }

  function changeAssigned($newUserId)
  {
    $pdo = new PDO('mysql:host=localhost;dbname=ngubanova;charset=utf8', 'ngubanova', 'neto1823');
    $sqlQuery = 'UPDATE task SET assigned_user_id = ? WHERE id = ? user_id = ?';
    $id = $_POST['task_id'];
    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare($sqlQuery);
    return $stmt->execute([$newUserId, $id, $userId]);
  }

  function getTasksByUserId()
  {
    $pdo = new PDO('mysql:host=localhost;dbname=ngubanova;charset=utf8', 'ngubanova', 'neto1823');
    $userId = $_SESSION['user_id'];
    $sqlQuery = 'SELECT * FROM task WHERE user_id = ? ORDER BY date_added ASC';
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute([$userId]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  function getTaskById($id)
  {
    $pdo = new PDO('mysql:host=localhost;dbname=ngubanova;charset=utf8', 'ngubanova', 'neto1823');
    $sqlQuery = 'SELECT * FROM task WHERE id = ?';
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
  }
?>
