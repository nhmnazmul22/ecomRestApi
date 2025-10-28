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
      $tags = Tag::all()->pluck('id')->toArray();

      foreach (Products::all() as $product) {
         $productTags = collect($tags)->shuffle()->take(5);
         $product->tags()->attach($productTags);
      }
   }
}
