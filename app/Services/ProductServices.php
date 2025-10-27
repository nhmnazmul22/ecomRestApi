<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Carbon\Carbon;
use Exception;

class ProductServices
{
   public function __construct(protected ProductRepository $repository)
   {
   }

   public function getProducts(array $filters = [])
   {
      $relations = ["category", "createdBy", "tags"];
      $products = $this->repository->all($filters, $relations);
      return $products;
   }

   public function getProduct(string $column, string|int $value)
   {
      $product = $this->repository->find($column, $value);
      if (!$product) {
         throw new Exception("Product not found", 404);
      }

      return $product;
   }

   public function create(array $data)
   {
      $existsProduct = $this->repository->find("sku", $data["sku"]);
      if ($existsProduct) {
         throw new Exception("Product already exits", 400);
      }
      return $this->repository->create($data);
   }

   public function update(string $id, array $data)
   {
      $existsProduct = $this->repository->find("id", $id);
      if (!$existsProduct) {
         throw new Exception("Product not found", 404);
      }
      return $this->repository->update($id, $data);
   }

   public function delete(string $id)
   {
      $category = $this->repository->find("id", $id);
      if (!$category) {
         throw new Exception("Category not found", 404);
      }
      return $this->repository->delete($id);
   }
}
