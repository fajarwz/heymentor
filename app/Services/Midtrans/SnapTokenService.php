<?php

namespace App\Services\Midtrans;

class SnapTokenService extends Midtrans
{
    private $order;
    private $user;

    public function __construct($order, $user)
    {
        parent::__construct();

        $this->order = $order;
        $this->user = $user;
    }

    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->id,
                'gross_amount' => $this->order->grand_total,
            ],
            'customer_details' => [
                'first_name' => $this->user->name,
                'last_name' => '',
                'email' => $this->user->email,
                'phone' => $this->user->phone_number,
            ],
        ];
        
        return \Midtrans\Snap::getSnapToken($params);
    }
}