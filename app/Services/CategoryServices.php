<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Carbon\Carbon;
use Exception;

class CategoryServices
{
   public function __construct(protected CategoryRepository $repository)
   {
   }

   public function create(array $data)
   {
      $existsCategory = $this->repository->findByName($data["name"]);
      if ($existsCategory) {
         throw new Exception("Category already exits", 400);
      }
      return $this->repository->create($data);
   }

   public function update(string $id, array $data)
   {
      $existsCategory = $this->repository->findById($id);
      if (!$existsCategory) {
         throw new Exception("Category not found", 404);
      }
      return $this->repository->update($id, $data);
   }

   public function getCategoriesList(array $filters = [])
   {
      $categories = $this->repository->all($filters);
      return categories;
   }

   public function delete(string $id)
   {
      $category = $this->repository->findById($id);
      if (!$category) {
         throw new Exception("Category not found", 404);
      }
      return $this->repository->delete($id);
   }

}
