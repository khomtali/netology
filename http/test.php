// Lection 2.3 HW "HTTP", Test

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
                <fieldset>
                    <legend>Please, enter your name to create a certificate</legend>
                    <label><input type='text' name='fio' placeholder='Full name'></label>
                </fieldset>
                <input type='submit' value='Send'>
            </form>
        <?php endif;
    endif;
    if(!empty($_POST)):
        $user = $_POST;
        $correct = $data['correct'];
        $len = count($correct);
        $check = $len + 1;
        if(count($user) < $check && $user['fio'] != null) // Проверка на полноту ответов, когда имя введено
            echo 'Please, answer all questions';
        elseif(count($user) == $check && $user['fio'] == null) // Проверка имени, когда есть все ответы
            echo 'Please, enter your name';
        elseif(count($user) <= $check && $user['fio'] == null) // Проверка полноты ответов и имени
            echo 'Please, answer all questions and enter your name';
        else {
            $name = $user['fio'];
            $right = 0;
            for($i = 0; $i < $len; $i++)
                if($correct[$i] == $user[$i])
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
            <a href='./Certificates/<?php echo $name ?>.png'>Download your certificate</a><hr>
            <a href='./list.php'>Choose another test</a><br>
            <a href='./admin.php'>Upload one more test</a>
        <?php }
    endif; ?>
</body>
</html>
