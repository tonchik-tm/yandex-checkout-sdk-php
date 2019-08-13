<?php

use YandexCheckout\Client;

require_once 'vendor/autoload.php';

$client = new Client();
$client->setAuthToken('AQAAAAAB_SvhAAWYqgF60ebwC02Gtd4ls_oZ96U');
//$client->setAuth('589966', 'test_nTV4jzp-Z5aHSrQ6ICrlVDKNcgvRZKFG9PKiOF6un1g');
//$client->setAuth('67192', 'live_mAeNtKJDYymlyvxTsWDtONAEMvRpcPFPp4PTjVwLgVU');

$types = array('payment', 'refund');
$selected_type = $_GET['type'] ?: 'payment';
$selected_item = $_GET['item_id'] ?: '';

try {
    //print_r($client->me());
    $filter = array(
        //'payment_id' => '24be8982-000f-5000-a000-14eaef4324e6',
        //'refund_id' => '24be8a16-0015-5000-a000-1915575ae95a',
    );
    if (!empty($selected_type) && !empty($selected_item)) {
        $filter[$selected_type.'_id'] = $selected_item;
        $result = $client->getReceipts($filter);
    } else {
        $result = 'NO DATA';
    }
    //print_r($response);
} catch (\Exception $e) {
    $result = $e;
}
?>
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
<div style="margin:30px;"><a href="./">На главную</a></div>
<div style="float:left;width:45%;border:1px solid grey;padding:30px;margin: 0 10px 30px 0;">
<form action="">
    <div><b>Чеки</b></div>
    <div style="float:left;width:20%;">
        Тип <select name="type" id="type">
            <?php foreach ($types as $type) echo '<option value="'.$type.'"'.($type==$selected_type?' selected':'').'>'.$type.'</option>'."\n"; ?>
        </select>
    </div>
    <div style="float:left;width:75%;">
        ID <input type="text" name="item_id" id="item_id" value="<?= $selected_item ?>" style="width:80%;">
    </div>
    <div style="clear:both;">
        <input type="submit" value="Отправить">
    </div>
</form>
</div>
<div style="float:left;width:45%;border:1px solid grey;padding:30px;">
</div>
<hr style="clear:both">
<pre>
<?php if (!empty($result)) print_r($result); ?>
</pre>
</body>
</html>
