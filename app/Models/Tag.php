<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Tag extends Model
{
   /** @use HasFactory<\Database\Factories\TagFactory> */
   use HasFactory, Notifiable;

   /**
    * The attributes that are mass assignable.
    *
    * @var list<string>
    */
   protected $fillable = [
      'name',
   ];


   public function products()
   {
      return $this->belongsToMany(Products::class, "product_tag", "tag_id", "product_id");
   }
}
