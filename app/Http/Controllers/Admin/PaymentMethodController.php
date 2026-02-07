<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $visa = new PaymentMethod([
            'name' => 'VISA',
            'code' => 'visa',
            'type' => 'credit_card',
            'is_enabled' => true,
        ]);

        $jcb = new PaymentMethod([
            'name' => 'JCB',
            'code' => 'jcb',
            'type' => 'credit_card',
            'is_enabled' => false,
        ]);

        $amex = new PaymentMethod([
            'name' => 'American Express',
            'code' => 'amex',
            'type' => 'credit_card',
            'is_enabled' => false,
        ]);

        $mastercard = new PaymentMethod([
            'name' => 'Mastercard',
            'code' => 'mastercard',
            'type' => 'credit_card',
            'is_enabled' => true,
        ]);

        $paypal = new PaymentMethod([
            'name' => 'PayPal',
            'code' => 'paypal',
            'type' => 'digital_wallet',
            'is_enabled' => true,
        ]);

        $applePay = new PaymentMethod([
            'name' => 'Apple Pay',
            'code' => 'apple_pay',
            'type' => 'digital_wallet',
            'is_enabled' => false,
        ]);

        $googlePay = new PaymentMethod([
            'name' => 'Google Pay',
            'code' => 'google_pay',
            'type' => 'digital_wallet',
            'is_enabled' => false,
        ]);

        return view('admin.payment-methods', compact(
            'visa',
            'jcb',
            'amex',
            'mastercard',
            'paypal',
            'applePay',
            'googlePay'
        ));
        
    }
}
