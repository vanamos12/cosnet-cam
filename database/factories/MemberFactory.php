<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'membershipid' => "PENDING",
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'cni_recto'  => '',
            'cni_verso' => ''
        ];
    }
}
