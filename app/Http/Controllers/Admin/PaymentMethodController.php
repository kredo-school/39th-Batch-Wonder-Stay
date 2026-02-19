<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $all_methods = PaymentMethod::all();

        if ($all_methods->isEmpty()) {
            $all_methods = collect([
            new PaymentMethod(['name' => 'VISA', 'code' => 'visa', 'type' => 'credit_card', 'is_enabled' => true]),
            new PaymentMethod(['name' => 'JCB', 'code' => 'jcb', 'type' => 'credit_card', 'is_enabled' => false]),
            new PaymentMethod(['name' => 'American Express', 'code' => 'amex', 'type' => 'credit_card', 'is_enabled' => false]),
            new PaymentMethod(['name' => 'Mastercard', 'code' => 'mastercard', 'type' => 'credit_card', 'is_enabled' => true]),
            new PaymentMethod(['name' => 'PayPal', 'code' => 'paypal', 'type' => 'digital_wallet', 'is_enabled' => true]),
            new PaymentMethod(['name' => 'Apple Pay', 'code' => 'applepay', 'type' => 'digital_wallet', 'is_enabled' => false]),
            new PaymentMethod(['name' => 'Google Pay', 'code' => 'googlepay', 'type' => 'digital_wallet', 'is_enabled' => false])
            ]);
        }

        $credit_cards = $all_methods->where('type', 'credit_card');
        $digital_wallets = $all_methods->where('type', 'digital_wallet');

        return view('admin.paymentmethods', compact('credit_cards', 'digital_wallets'));
        
    }

    public function enable($code)
    {
        $method = PaymentMethod::where('code', $code)->firstOrFail();
        $method->update(['is_enabled' => true]);

        return redirect()->back()->with('success', 'Payment method enabled!');
    }

    public function disable($code)
    {
        $method = PaymentMethod::where('code', $code)->firstOrFail();
        $method->update(['is_enabled' => false]);

        return redirect()->back()->with('success', 'Payment method disabled!');
    }
}
