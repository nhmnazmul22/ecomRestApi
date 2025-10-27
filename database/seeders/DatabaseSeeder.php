<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   use WithoutModelEvents;

   /**
    * Seed the application's database.
    */
   public function run(): void
   {
      // User::factory(5)->create();

      //   User::factory()->create([
      //       'name' => 'Test Admin',
      //       'email' => 'admin@example.com',
      //       "role" => "admin"
      //   ]);

      // Category::factory(10)->create();

      // $this->call(TagSeeder::class);

      $this->call(ProductSeeder::class);
   }
}
