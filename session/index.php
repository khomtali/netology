<?php
    require_once 'functions.php';

    $errors = [];
    $file = __DIR__ . '/Users/{login}.json';
    if(!empty($_POST['login']) && !empty($_POST['password'])) {
        if(file_exists($file)) {
            if(login($_POST['login'], $_POST['password'])) {
                header('Location: ./list.php');
                die;
            } else $errors[] = 'Incorrect login or password';
        } else $errors[] = 'There is no user database, please, sign in as a guest';
    } elseif(!empty($_POST['login']) && empty($_POST['password'])) {
        $guestName = $_POST['login'];
        setcookie('guest_name', $guestName);
        header('Location: ./list.php');
    } else $errors[] = 'Please, enter your personal data to sign in';
?>

<html lang=«en»>
<head>
    <title>Authorization</title>
    <meta charset='utf-8'>
</head>
<body>
    <h1>Please, sign in the testing system</h1>
    <?php if(!empty($errors)): ?>
        <ul>
        <?php foreach($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method='POST'>
        <div>
            <label>Login:</label>
            <input type='text' placeholder='Login or Name' name='login'>
        </div>
        <div>
            <label>Password:</label>
            <input type='text' placeholder='Password' name='password'>
        </div>
        <small>* to sign in as a guest please enter only a name</small>
        <div>
            <input type='submit' value='Sign in'>
        </div>
    </form>
</body>
</html>
