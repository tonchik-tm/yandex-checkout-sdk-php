<?php

use YandexCheckout\Client;
use YandexCheckout\Model\Notification\NotificationSucceeded;
use YandexCheckout\Model\Notification\NotificationWaitingForCapture;
use YandexCheckout\Model\NotificationEventType;

require_once 'vendor/autoload.php';

$client = new Client();
$client->setAuth('shopId', 'shopPassword');

$paymentId = '215d8da0-000f-50be-b000-0003308c89be';
$payment = $client->getPaymentInfo($paymentId);


$notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
    ? new NotificationSucceeded($requestBody)
    : new NotificationWaitingForCapture($requestBody);
