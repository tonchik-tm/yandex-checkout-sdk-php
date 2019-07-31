<?php

/**
 * The MIT License
 *
 * Copyright (c) 2017 NBCO Yandex.Money LLC
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace YandexCheckout\Request\Receipts;

use YandexCheckout\Common\Exceptions\InvalidPropertyValueException;
use YandexCheckout\Common\Exceptions\InvalidPropertyValueTypeException;
use YandexCheckout\Helpers\TypeCast;

/**
 * Class PaymentReceipt
 * @package YandexCheckout\Model
 *
 * @property string $payment_id Идентификатор платежа в Яндекс.Кассе.
 * @property string $paymentId Идентификатор платежа в Яндекс.Кассе.
 */
class PaymentReceiptResponse extends AbstractReceiptResponse
{
    private $_payment_id;

    /**
     * Установка свойств, присущих конкретному объекту
     *
     * @param array $receiptData
     *
     * @return void
     */
    public function setSpecificProperties($receiptData)
    {
        $this->setPaymentId($receiptData['payment_id']);
    }

    /**
     * @return string
     */
    public function getPaymentId()
    {
        return $this->_payment_id;
    }

    /**
     * Устанавливает идентификатор платежа в Яндекс.Кассе
     *
     * @param string $value Идентификатор платежа в Яндекс.Кассе
     *
     * @throws InvalidPropertyValueTypeException Выбрасывается если в качестве значения была передана не строка
     * @throws InvalidPropertyValueException Выбрасывается если длина переданной строки не равна 36
     */
    public function setPaymentId($value)
    {
        if ($value === null || $value === '') {
            $this->_payment_id = null;
        } elseif (!TypeCast::canCastToString($value)) {
            throw new InvalidPropertyValueTypeException('Invalid payment_id value type', 0, 'Receipt.paymentId');
        } elseif (strlen((string)$value) !== self::LENGTH_PAYMENT_ID) {
            throw new InvalidPropertyValueException(
                'Invalid payment_id value: "'.$value.'"', 0, 'Receipt.paymentId', $value
            );
        } else {
            $this->_payment_id = (string)$value;
        }
    }

}