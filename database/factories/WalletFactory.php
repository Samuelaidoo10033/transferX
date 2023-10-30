<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'currency' => fake()->currencyCode(),
            'country' => 'Ghana',
            'balance' => fake()->randomNumber(1, 10),
            'number' => '202842847246',
        ];
    }
}
