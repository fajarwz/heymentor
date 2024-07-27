<?php

namespace App\Services\Midtrans;

use Midtrans\Notification;

class NotificationService extends Midtrans
{
    private $notification;
    private $order;
    private $model;
    private $id;

    public function __construct($model, $id = 'id')
    {
        parent::__construct();

        $this->model = $model;
        $this->id = $id;

        $this->handleNotification();
    }

    public function isSignatureKeyVerified() {
        return $this->createSignatureKey($this->notification, $this->order) === $this->notification->signature_key;
    }

    public function isSuccess()
    {
        $transactionStatus = $this->notification->transaction_status;
        $transactionType = $this->notification->payment_type;
        $transactionFraudStatus = $this->notification->fraud_status;

        if ($transactionStatus == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($transactionType == 'credit_card') {
                if ($transactionFraudStatus == 'accept') {
                    return true;
                }
            }
        }

        if ($transactionStatus == 'settlement') {
            return true;
        }

        return false;
    }

    public function isChallenge()
    {
        $transactionStatus = $this->notification->transaction_status;
        $transactionType = $this->notification->payment_type;
        $transactionFraudStatus = $this->notification->fraud_status;

        if ($transactionStatus == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($transactionType == 'credit_card') {
                if ($transactionFraudStatus == 'challenge') {
                    return true;
                }
            }
        }

        return false;
    }

    public function isPending()
    {
        return $this->notification->transaction_status === 'pending';
    }

    public function isExpired()
    {
        return $this->notification->transaction_status === 'expire';
    }

    public function isCancelled()
    {
        return $this->notification->transaction_status === 'cancel';
    }

    public function getNotification()
    {
        return $this;
    }

    public function getOrder()
    {
        return $this->order;
    }

    private function createSignatureKey($notif, $order)
    {
        $orderId = $order->id;
        $statusCode = $notif->status_code;
        $grossAmount = number_format($order->grand_total, 2, '.', '');

        $signatureBuilder = $orderId . $statusCode . $grossAmount . $this->serverKey;
        // info($signatureBuilder);
        $signature = openssl_digest($signatureBuilder, 'sha512');

        return $signature;
    }

    private function handleNotification()
    {
        $notification = new Notification();

        $orderId = $notification->order_id;
        $order = $this->model::where($this->id, $orderId)->first();

        $this->notification = $notification;
        $this->order = $order;

        if(!$this->isSignatureKeyVerified()) {
            abort(403, 'Invalid signature');
        }
    }
}