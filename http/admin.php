// Lection 2.3 HW "HTTP", Admin

<html lang=«en»>
<head>
    <title>Test Uploading</title>
    <meta charset='utf-8'>
</head>
<body>
    <form action='admin.php' method='POST' enctype='multipart/form-data'>
        <div>Please, upload a .json file with a test:</div>
        <input type='file' name='test'>
        <div><input type='submit' value='Upload'></div>
    </form>
</body>
</html>

<?php
if(!empty($_FILES)) {
    if(array_key_exists('test', $_FILES)) {
        if($_FILES['test']['type'] != 'application/json') {
            echo 'Sorry, we allow uploading only JSON files';
            exit;
        } else {
            $name = $_FILES['test']['name'];
            $dest = "./Tests/$name";
            move_uploaded_file($_FILES['test']['tmp_name'], $dest);
            header('Location: ./list.php');?>
        <?php }
    }
}
?>

<a href='./list.php'>To the list of tests</a>
