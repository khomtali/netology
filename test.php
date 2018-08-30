// Lection 2.2 HW "Tests" Test

<html>
<head>
    <title>Test</title>
    <meta charset="utf-8">
</head>
<body>
    <form action="test.php" method="GET">
        <div>Input number of test</div>
        <input type="text" name="testnumber">
        <input type="submit" value="Send">
    </form>
    <?php
    if(!empty($_GET)) {
        if(array_key_exists('testnumber', $_GET)):
            $number = (int)$_GET['testnumber'];
            $string = file_get_contents(__DIR__ . "/Tests/test" . $number . ".json");
            if (!$string)
                header('HTTP/1.1 404 Not Found', $http_response_code = 404);
            else {
                $data = json_decode($string, true);?>
                <form action="test.php" method="POST">
                    <?php foreach($data as $question => $answers): ?>
                        <fieldset>
                            <legend><?php echo "$question<br>";?></legend>
                            <?php foreach($answers as $value): ?>
                                <label><input type="radio" name="answer"><?php echo " $value";?></label>
                            <?php endforeach;?>
                        </fieldset>
                    <?php endforeach;?>
                    <input type="submit" value="Send">
                </form>
            <?php }
        endif;
    }?>
</body>
</html>
