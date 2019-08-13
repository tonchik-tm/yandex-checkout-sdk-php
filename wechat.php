<?php

use Endroid\QrCode\QrCode;
use YandexCheckout\Client;
use YandexCheckout\Request\Payments\PaymentResponse;

require_once 'vendor/autoload.php';

$client = new Client();
//$client->setAuthToken('AQAAAAAB_SvhAAWYqgF60ebwC02Gtd4ls_oZ96U');
//$client->setAuth('589966', 'test_nTV4jzp-Z5aHSrQ6ICrlVDKNcgvRZKFG9PKiOF6un1g');
//$client->setAuth('67192', 'live_mAeNtKJDYymlyvxTsWDtONAEMvRpcPFPp4PTjVwLgVU');
$client->setAuth('170132', 'live_Cn1aFmsIgR7620gTArHtS7UIdvCGr1KOlkPHD16fADw');

try {
    $result = $client->createPayment(array(
        'amount' => array(
            'value' => '2.00',
            'currency' => 'RUB'
        ),
        'payment_method_data' => array(
            'type' => 'wechat'
        ),
        'confirmation' => array(
            'type' => 'qr'
        ),
        'capture' => true,
        'description' => 'Заказ №72'
    ), uniqid('', true));
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
    <title>Test SDK WeChat</title>
</head>
<body>
<div style="margin:30px;"><a href="./">На главную</a></div>
<?php
if (!empty($result)) echo '<pre>'; print_r($result); echo '</pre>';
try {
//if (!empty($result) && $result instanceof PaymentResponse) {
    $qrCode = new QrCode($result->getConfirmation()->getConfirmationData());
    //$qrCode = new QrCode('weixin://wxpay/bizpayurl?pr=lLt3BHA');
    echo '<img src="' . $qrCode->writeDataUri() . '">';
//}
} catch (\Exception $e) {
    echo '<pre>'; print_r($e); echo '</pre>';
}
?>
</body>
</html>
