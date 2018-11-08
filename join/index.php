<?php
  require_once 'taskFunctions.php';
  require_once 'authFunctions.php';

  $tasksByUserId = getTasksByUserId();
  $assignedUserList = getUsers();
  $taskNumber = countTasks();
  $messages = [];

  if(!isAuthorized()) {
    header('Location: ./authorization.php');
    die;
  }
  if(!empty($_POST['refresh'])) {
    header('Refresh: 0');
  }
  if(!empty($_POST['deletedTask'])) {
    deleteTask();
  }
  if(!empty($_POST['changedTask'])) {
    changeStatus();
  }
  if(!empty($_POST['addTask'])) {
    addTask();
    $messages[] = 'The task was added!';
  }
?>

<html lang="en">
<head>
    <title>Task Manager</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Task Manager</h1>
    <?php if(!empty($messages)): ?>
        <ul>
        <?php foreach($messages as $message): ?>
            <li><?php echo $message; ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div>
        <form method="POST">
            <textarea name="task" placeholder="Enter the task description" rows="2" cols="30" required></textarea>
            <input type="submit" name="addTask" value="Add the task">
        </form>
    </div>
    <div>
        <form method="POST">
            <input type="hidden" name="refresh" value="1">
            <button type="submit">Refresh this page</button>
        </form>
        <p>Total tasks: <?php echo $taskNumber; ?></p>
    </div>
    <div>
        <?php if(empty($tasksByUserId)): ?>
            <p><?php echo $_SESSION['user']; ?>, you haven't added any task yet</p>
        <?php else: ?>
            <table class="tasksOfUser" border="1">
                <tr>
                    <th>User added</th>
                    <th>User assigned</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date added</th>
                </tr>
                <?php foreach ($tasksByUserId as $task): ?>
                    <tr>
                        <td><?php echo $_SESSION['user']; ?></td>
                        <td>
                            <?php echo $task['assigned_user_id'] == $_SESSION['user_id'] ? $_SESSION['user'] : $task['assigned_user_id'] ?>
                            <form method="POST">
                                <input name="task_id" type="hidden" value="<?php echo $task['id']; ?>">
                                <select name="assigned_user_id">
                                    <?php foreach ($assignedUserList as $assignedUser): ?>
                                        <option <?php if ($task['assigned_user_id'] == $assignedUser['id']):?> selected <?php endif;
                                        ?> value="<?php echo $assignedUser['id'] ?>">
                                            <?php echo $assignedUser['login'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">Delegate</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="deletedTask" value="<?php echo $task['id']; ?>">
                                <button type="submit">Delete</button>
                                <?php echo $task['description']; ?>
                            </form>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="changedTask" value="<?php echo $task['id']; ?>">
                                <button type="submit"><?php echo $task['is_done'] ? 'Undone' : 'To be done';?></button>
                                <?php echo $task['is_done'] ? 'Done' : 'In progress'; ?>
                            </form>
                        </td>
                        <td><?php echo $task['date_added']; ?></td>
                    </tr>

                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <ul>
        <li><a href='./logout.php'>Sign out</a></li>
    </ul>
</body>
</html>
