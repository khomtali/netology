<?php
    require_once 'functions.php';
    if(empty($_COOKIE['guest_name']) && !isAuthorized()):
        http_response_code(403);
        die("Access denied. Please, log in or enter as a guest at <a href='./index.php'>this page</a>");
    endif;
?>

<html>
<head>
    <title>Test</title>
    <meta charset='utf-8'>
</head>
<body>
    <?php
    if(!empty($_GET)) {
        if(array_key_exists('testnumber', $_GET)):
            $number = (int)$_GET['testnumber'];
            $string = file_get_contents(__DIR__ . '/Tests/test' . $number . '.json');
            if (!$string)
                header('HTTP/1.1 404 Not Found', $http_response_code = 404);
            else
                $data = json_decode($string, true);
        endif;
    } else header('Location: ./list.php', $http_response_code = 301);
    if(!empty($_GET)):
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
                <input type='submit' value='Send'>
            </form>
        <?php endif;
    endif;
    if(!empty($_POST)):
        $userAnswers = $_POST;
        $correct = $data['correct'];
        $len = count($correct);
        if(count($userAnswers) < $len) { // Проверка на полноту ответов
            echo 'Please, answer all questions';
        } else {
            if(isAuthorized())
                $name = $_SESSION['user']['name'];
            else $name = $_COOKIE['guest_name'];
            $right = 0;
            for($i = 0; $i < $len; $i++)
                if($correct[$i] == $userAnswers[$i])
                    $right++;
            echo "You scored $right out of $len<br>";?>
            <?php $result = (int)($right / $len * 100);
            $certificate = imagecreatetruecolor (400, 200);
            $color_fill = imagecolorallocate($certificate, 0, 200, 0);
            imagefill($certificate, 0, 0, $color_fill);
            $color_h1 = imagecolorallocate($certificate, 255, 0, 0);
            $color_txt = imagecolorallocate($certificate, 100, 100, 100);
            imagestring($certificate, 5, 150, 50, 'Certificate', $color_h1);
            imagestring($certificate, 3, 100, 100, "$name,", $color_txt);
            imagestring($certificate, 3, 130, 120, "your result is $result%", $color_txt);
            imagepng($certificate, "./Certificates/$name.png");
            imagedestroy($certificate);?>
            <a href='./Certificates/<?php echo $name ?>.png' target='blank'>Download your certificate</a><hr>
            <a href='./list.php'>Choose another test</a><br>
            <?php if(isAuthorized()): ?>
                <a href='./admin.php'>Upload one more test</a><br>
            <?php endif; ?>
            <a href='./logout.php'>Sign out</a>
        <?php }
    endif; ?>
</body>
</html>
