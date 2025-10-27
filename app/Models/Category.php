<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Str;

class Category extends Model
{
   /** @use HasFactory<\Database\Factories\CategoryFactory> */
   use HasFactory, Notifiable;

   /**
    * The attributes that are mass assignable.
    *
    * @var list<string>
    */
   protected $fillable = [
      'name',
      "status",
      "description"
   ];

   public function products()
   {
      return $this->hasMany(Products::class);
   }


}
