<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
   /**
    * Define the model's default state.
    *
    * @return array<string, mixed>
    */
   public function definition(): array
   {

      return [
         'title' => $this->faker->words(3, true),
         "sku" => strtoupper($this->faker->unique()->bothify("SKU-????-####")),
         "description" => $this->faker->sentence(15),
         "price" => $this->faker->randomFloat(2, 500, 50000),
         "category_id" => Category::query()->inRandomOrder()->first()?->id ?? Category::factory(),
         "created_by" => User::query()->inRandomOrder()->first()?->id ?? User::factory(),
      ];
   }
}
