<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::orderBy('type')->orderBy('name')->get();

        return view('admin.payment-methods', compact('paymentMethods'));
    }

    public function toggle(PaymentMethod $paymentMethod)
    {
        $paymentMethod->update(['is_enabled' => !$paymentMethod->is_enabled]);

        return back();
    }
}
