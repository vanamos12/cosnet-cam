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
            'town' => "Douala",
            'email' => fake()->unique()->safeEmail(),
            'birthday' => '1990-09-01',
            'phone' => fake()->phoneNumber(),
            'cni_number' => '',
            'cni_recto'  => '',
            'cni_verso' => ''
        ];
    }
}
