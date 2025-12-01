<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tipodocumento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'numdoc' => $this->faker->unique()->randomNumber(),
            'nomrazonsocial' => $this->faker->unique()->name(),
            'address' => $this->faker->name(),
            'phone' => $this->faker->randomNumber(),
            'movil' => $this->faker->randomNumber(),
            'email' => $this->faker->unique()->safeEmail,
            'contact' => $this->faker->name,
            'state' => true,
            'user_id' =>User::all()->random()->id,
            'tipodocumento_id' =>Tipodocumento::all()->random()->id,
        ];
    }
}
