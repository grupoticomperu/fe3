<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Currency;
use App\Models\Um;
use App\Models\Modelo;
use App\Models\Category;
Use App\Models\Brand;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->randomNumber(),
            'codigobarras' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->unique()->name(),
            'description' => $this->faker->paragraph(),
            'purchaseprice' => $this->faker->randomElement([100, 105, 110, 115, 120]),
            'saleprice' => $this->faker->randomElement([160, 165, 170, 175, 180]),
            'salepricemin' => $this->faker->randomElement([130, 135, 140, 145, 150]),

            'currency_id' => Currency::all()->random()->id,
            'um_id' => Um::all()->random()->id,
            'modelo_id' => Modelo::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'brand_id' => Brand::all()->random()->id,
            'state' => true,
            'image' => '/storage/products/' . $this->faker->image('public/storage/products', 200, 150, null, false),


        ];
    }
}
