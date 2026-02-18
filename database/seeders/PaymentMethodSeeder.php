<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['name' => 'VISA', 'code' => 'visa', 'type' => 'credit_card'],
            ['name' => 'JCB', 'code' => 'jcb', 'type' => 'credit_card'],
            ['name' => 'Mastercard', 'code' => 'mastercard', 'type' => 'credit_card'],
            ['name' => 'American Express', 'code' => 'amex', 'type' => 'credit_card'],
            ['name' => 'PayPal', 'code' => 'paypal', 'type' => 'digital_wallet'],
            ['name' => 'Apple Pay', 'code' => 'apple_pay',  'type' => 'digital_wallet'],
            ['name' => 'Google Pay', 'code' => 'google_pay', 'type' => 'digital_wallet'],
        ];

        foreach ($methods as $m) {
            PaymentMethod::updateOrCreate(
                ['code' => $m['code']],
                [
                    'name' => $m['name'],
                    'type' => $m['type'],
                    'is_enabled' => true,
                ]
            );
        }
    }
}
