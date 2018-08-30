//Lection 2.2 HW "Tests"

<html lang=«en»>
<head>
    <title>Test Uploading</title>
    <meta charset="utf-8">
</head>
<body>
    <form action="admin.php" method="POST" enctype="multipart/form-data">
        <legend>Please, upload a .json file with a test</legend>
        <input type="file" name="test">
        <div><input type="submit" value="Upload"></div>
    </form>
</body>
</html>

<?php
if(!empty($_FILES)) {
    if(array_key_exists('test', $_FILES)) {
        if($_FILES['test']['type'] != "application/json") {
            echo "Sorry, we only allow uploading JSON files";
            exit;
        } else {
            $name = $_FILES['test']['name'];
            $dest = "./Tests/$name";
            move_uploaded_file($_FILES['test']['tmp_name'], $dest);
            echo "The file is uploaded successfully!<br>";?>
            <a href="/u/ngubanova/me/Lection%202.2/list.php">To the list of tests</a>
        <?php }
    }
}
?>
