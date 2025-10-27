<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{

   public function __construct(Category $category)
   {
      parent::__construct($category);
   }
   public function findByName(string $name)
   {
      $category = $this->model->where("name", $name)->first();
      return $category;
   }
   public function findById(string $id)
   {
      $category = $this->model->where("id", $id)->first();
      return $category;
   }

   public function getModel()
   {
      return $this->model;
   }
}
