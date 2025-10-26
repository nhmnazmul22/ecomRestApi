<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   /**
    * Run the migrations.
    */
   public function up(): void
   {
      Schema::create('products', function (Blueprint $table) {
         $table->uuid("id")->primary();
         $table->string("image_url")->nullable();
         $table->string('title');
         $table->string("sku")->unique();
         $table->string('description');
         $table->integer("discount")->default(0);
         $table->decimal('price', 10, 2);
         $table->integer("stock")->default(0);
         $table->enum("status", ["in_stock", "out_of_stock"])->default("out_of_stock");
         $table->foreignUuid("category_id")->constrained("categories", "id");
         $table->foreignUuid('created_by')
            ->constrained('users', 'id');
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists("products");
   }
};
