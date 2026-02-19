<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run(): void
    {
        $methods = [
            ['name' => 'VISA', 'code' => 'visa', 'type' => 'credit_card', 'is_enabled' => true],
            ['name' => 'JCB', 'code' => 'jcb', 'type' => 'credit_card', 'is_enabled' => false],
            ['name' => 'American Express', 'code' => 'amex', 'type' => 'credit_card', 'is_enabled' => false],
            ['name' => 'Mastercard', 'code' => 'mastercard', 'type' => 'credit_card', 'is_enabled' => true],
            ['name' => 'PayPal', 'code' => 'paypal', 'type' => 'digital_wallet', 'is_enabled' => true],
            ['name' => 'Apple Pay', 'code' => 'applepay', 'type' => 'digital_wallet', 'is_enabled' => false],
            ['name' => 'Google Pay', 'code' => 'googlepay', 'type' => 'digital_wallet', 'is_enabled' => false],
        ];

        foreach ($methods as $method) {
            \App\Models\PaymentMethod::create($method);
        }
    }    
}
