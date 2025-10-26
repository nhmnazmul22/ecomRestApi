<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      Products::factory(50)->create();

      foreach (Products::all() as $product) {
        $tags = Tag::query()->inRandomOrder()->take(rand())->pluck("id");
        $product->tags()->attach($tags);
      }
   }
}
