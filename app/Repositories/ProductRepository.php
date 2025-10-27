<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Products;

class ProductRepository extends BaseRepository
{

   public function __construct(Products $product)
   {
      parent::__construct($product);
   }
}
