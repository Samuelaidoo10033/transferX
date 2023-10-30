<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipient>
 */
class RecipientFactory extends Factory
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
            'type' => 'momo',
            'currency' => 'GHC',
            'country' => 'Ghana',
            'name' => 'James Test',
            'number' => '202842847246',
            'provider' => 'Fidelity'
        ];
    }
}
