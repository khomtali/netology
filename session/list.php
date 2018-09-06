<?php
    require_once 'functions.php';
    if(empty($_COOKIE['guest_name']) && !isAuthorized()) {
        http_response_code(403);
        die("Access denied. Please, log in or enter as a guest at <a href='./index.php'>this page</a>");
    }
    if(isset($_POST['del_file'])) {
        $file = './Tests/'.$_POST['del_file'];
        $result = unlink($file);
    }
?>

<html lang=«en»>
<head>
    <title>List of Tests</title>
    <meta charset='utf-8'>
</head>
<body>
    <ul>
        <?php
        $dir = './Tests/';
        $skip = array('.','..');
        $files = scandir($dir);
        foreach($files as $key => $file):
            if(!in_array($file, $skip)):
                $k = $key - 1;
                $link = 'test.php?testnumber='.$k;
                $number = substr($file,4,1);
                echo "<li><a href='$link'>Test #$number</a></li>";
                if(isAuthorized()): ?>
                    <form method='POST'>
                        <input type='hidden' name='del_file' value='<?php echo $file; ?>'>
                        <input type='submit' value='Delete'>
                    </form>
                <?php endif;
            endif;
        endforeach; ?>
    </ul><hr>
    <ul>
        <?php if(isAuthorized()) { ?>
            <li><a href='./admin.php'>Upload one more test</a></li>
        <?php } ?>
            <li><a href='./logout.php'>Sign out</a></li>
</body>
</html>
