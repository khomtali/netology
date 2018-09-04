// Lection 2.2 HW "Tests", Test

<html>
<head>
    <title>Test</title>
    <meta charset="utf-8">
</head>
<body>
    <?php
    if(!empty($_GET)) {
        if(array_key_exists('testnumber', $_GET)):
            $number = (int)$_GET['testnumber'];
            $string = file_get_contents(__DIR__ . "/Tests/test" . $number . ".json");
            if (!$string)
                header('HTTP/1.1 404 Not Found', $http_response_code = 404);
            else
                $data = json_decode($string, true);
        endif;
    } else header('Location: ./list.php', $http_response_code = 301);
    if(!empty($_GET)) {
        if(array_key_exists('testnumber', $_GET)):
            $i = 0; ?>
            <form action='test.php?testnumber=<?php echo $_GET['testnumber']?>' method='POST'>
                <?php foreach($data['test'] as $question => $answers): ?>
                    <fieldset>
                        <legend><?php echo "$question<br>";?></legend>
                        <?php
                        $n = 1;
                        foreach($answers as $value): ?>
                            <label>
                                <input type='radio'
                                name='<?php echo $i; ?>'
                                value='<?php echo "a$n"?>'><?php echo " $value";?>
                            </label>
                            <?php $n++;
                        endforeach;
                        $i++; ?>
                    </fieldset>
                <?php endforeach;?>
                <input type="submit" value="Send">
                </form>
            <?php endif;
    }
    if (!empty($_POST))
        if($_POST === $data['correct']) {
            echo "You've done it!<br>";?>
            <a href="./list.php">Choose another test</a><br>
            <a href="./admin.php">Upload one more test</a>
        <?php } else {
            echo 'Try again, baby. Or...<br>'; ?>
            <a href="./list.php">Choose another test</a><br>
            <a href="./admin.php">Upload one more test</a>
        <?php } ?>
</body>
</html>
