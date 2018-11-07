<?php
  require_once 'authFunctions.php';

  $errors = [];
  if(!empty($_POST['login']) && !empty($_POST['password'])) {
    if(!empty($_POST['signIn'])) {
      if(login($_POST['login'], $_POST['password'])) {
        header('Location: ./index.php');
        die;
      } else $errors[] = 'Incorrect login or password';
    }
    if(!empty($_POST['signUp'])) {
      if(empty(userExistence($_POST['login']))) {
        if(register($_POST['login'], $_POST['password'])) {
          $errors[] = 'Registration is successful. Please, enter your personal data to sign in';
        }
      } else $errors[] = 'Login already exists. Choose another one';
    }
  } else $errors[] = 'Please, enter your personal data to sign in. Or sign up';
?>

<html lang="en">
<head>
    <title>Authorization</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Authorization</h1>
    <?php if(!empty($errors)): ?>
        <ul>
        <?php foreach($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="POST">
        <div>
            <label>Login:</label>
            <input type="text" name="login" placeholder="Login">
        </div>
        <div>
            <label>Password:</label>
            <input type="text" name="password" placeholder="Password">
        </div>
        <input type="submit" name="signIn" value="Sign in">
        <input type="submit" name="signUp" value="Sign up">
    </form>
</body>
</html>
