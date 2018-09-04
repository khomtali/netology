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
        foreach($files as $key => $file):
            if(!in_array($file, $skip)):
                $k = $key - 1;
                $link = 'test.php?testnumber='.$k;
                $number = substr($file,4,1);
                echo "<li><a href=$link>Test #$number</a></li>";
            endif;
        endforeach;?>
    </ul>
    <a href="./admin.php">Upload one more test</a>
</body>
</html>
