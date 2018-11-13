<?php
  require_once 'connection.php';

  function addTask()
  {
    $pdo = connect();
    $id = $_SESSION['user_id'];
    $sqlQuery = 'INSERT INTO task(user_id, assigned_user_id, description, date_added) VALUES (?, ?, ?, NOW())';
    $task = $_POST['task'];
    $stmt = $pdo->prepare($sqlQuery);
    return $stmt->execute([$id, $id, $task]);
  }

  function deleteTask()
  {
    $pdo = connect();
    $sqlQuery = 'DELETE FROM task WHERE user_id = ? AND id = ? LIMIT 1';
    $id = $_POST['deletedTask'];
    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare($sqlQuery);
    return $stmt->execute([$userId, $id]);
  }

  function changeStatus()
  {
    $pdo = connect();
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
    $pdo = connect();
    $sqlQuery = 'UPDATE task SET assigned_user_id = ? WHERE id = ?';
    $id = $_POST['task_id'];
    $stmt = $pdo->prepare($sqlQuery);
    return $stmt->execute([$newUserId, $id]);
  }

  function countTasks()
  {
    $pdo = connect();
    $sqlQuery = 'SELECT count(*) FROM task WHERE user_id = ? OR assigned_user_id = ?';
    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute([$userId, $userId]);
    $result = $stmt->fetch()['count(*)'];
    return $result;
  }

  function getTasksByUserId()
  {
    $pdo = connect();
    $userId = $_SESSION['user_id'];
    $sqlQuery = 'SELECT t.id, t.user_id, u.login, t.assigned_user_id, t.description, t.is_done, t.date_added
    FROM task t INNER JOIN user u ON u.id = t.assigned_user_id WHERE user_id = ? ORDER BY date_added ASC';
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute([$userId]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  function getTasksByAssigned()
  {
    $pdo = connect();
    $userId = $_SESSION['user_id'];
    $sqlQuery = 'SELECT t.id, t.user_id, u.login, t.assigned_user_id, t.description, t.is_done, t.date_added
    FROM task t INNER JOIN user u ON u.id=t.user_id WHERE t.user_id <> ? AND t.assigned_user_id = ? ORDER BY date_added ASC';
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute([$userId, $userId]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  function getTaskById($id)
  {
    $pdo = connect();
    $sqlQuery = 'SELECT * FROM task WHERE id = ?';
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
  }
?>
