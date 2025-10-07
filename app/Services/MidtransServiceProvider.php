<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Midtrans\Config;

class MidtransServiceProvider
{
    public function boot(): void
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction($orderId, $itemTotal)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $itemTotal,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return $snapToken;
    }
}
