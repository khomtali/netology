// Lection 2.2 HW "Tests", List

<html lang=«en»>
<head>
    <title>List of Tests</title>
    <meta charset="utf-8">
</head>
<body>
    <ul>
        <?php $dir = './Tests/';
        $skip = array('.','..');
        $files = scandir($dir);
        foreach($files as $file)
            if(!in_array($file, $skip))
                echo "<li>$file</li>";?>
    </ul>
    <a href="/u/ngubanova/me/Lection%202.2/test.php">Start testing!</a>
</body>
</html>
