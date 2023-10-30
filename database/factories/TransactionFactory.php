<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentMethods = ['bank_transfer', 'mobile_money', 'card', 'wallet'];
        $statuses = ['pending', 'processing', 'cancelled', 'refunded', 'completed'];
        $destinations = ['bank', 'mobile_money', 'wallet'];

        return [
            'user_id' => 1,
            'recipient_id' => 1,
            'wallet_id' => 1,
            'reference' => $this->faker->unique()->randomNumber(8),
            'provider_reference' =>$this->faker->unique()->randomNumber(8),
            'recipient_name' =>$this->faker->name,
            'recipient_number' =>$this->faker->phoneNumber,
            'recipient_provider' =>$this->faker->randomElement(['A01', 'B02', 'C03']),
            'bank_code' =>$this->faker->randomElement(['A001', 'B0002', 'C0003']),
            'payment_method' =>$this->faker->randomElement($paymentMethods),
            'amount' =>$this->faker->randomFloat(4, 1, 100),
            'rate' =>$this->faker->randomFloat(4, 0.5, 2),
            'fee' =>$this->faker->randomFloat(4, 0, 10),
            'from' =>$this->faker->randomElement(['NGN', 'GHC']),
            'to' =>$this->faker->randomElement(['NGN', 'GHC']),
            'status' =>$this->faker->randomElement($statuses),
            'destination' =>$this->faker->randomElement($destinations),
            'metadata' => null, // You can set any custom metadata if needed
            'deleted_at' => null,
            'created_at' =>$this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' =>$this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
