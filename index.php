<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test SDK</title>
</head>
<body>
<div style="width:45%;border:1px solid grey;padding:15px 30px;margin:30px auto;">
    <h3>Test PHP SDK</h3>
<?php
    $tests = array(
        'receipts',
        'wechat',
    );
    foreach ($tests as $test) {
        echo '<p><a href="' . $test . '.php">' . ucfirst($test) . '</a></p>';
    }
?>
</div>
</body>
</html>
