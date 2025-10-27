<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Products extends Model
{
   /** @use HasFactory<\Database\Factories\ProductsFactory> */
   use HasFactory, Notifiable;

   /**
    * The attributes that are mass assignable.
    *
    * @var list<string>
    */
   protected $fillable = [
      "image_url",
      'title',
      "sku",
      "description",
      "discount",
      "stock",
      "price",
      "tags",
      "category_id",
      "created_by",
   ];


   public function category()
   {
      return $this->belongsTo(Category::class);
   }

   public function createdBy()
   {
      return $this->belongsTo(User::class, "created_by", "id");
   }

   public function tags()
   {
      return $this->belongsToMany(Tag::class, "product_tag", "product_id", "tag_id");
   }
}
