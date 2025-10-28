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

   public function getProducts(array $requestFilters = [])
   {
      // dd($requestFilters);
      $relations = ["category", "createdBy", "tags"];
      $filters = [];
      if (!empty($requestFilters["status"])) {
         $filters['status'] = $requestFilters['status'] ?? "in_stock";
      }
      if (!empty($requestFilters["from"]) || !empty($requestFilters["to"])) {
         $filters["created_at"] = [
            "from" => Carbon::parse($requestFilters["from"])->startOfDay(),
            "to" => Carbon::parse($requestFilters["to"])->endOfDay()
         ];
      }
      if (!empty($requestFilters["from_price"]) || !empty($requestFilters["to_price"])) {
         $filters["price"] = [
            "from" => (int) $requestFilters["from_price"],
            "to" => (int) $requestFilters["to_price"]
         ];
      }
      if (!empty($requestFilters["from_stock"]) || !empty($requestFilters["to_stock"])) {
         $filters["stock"] = [
            "from" => $requestFilters["from_stock"],
            "to" => $requestFilters["to_stock"]
         ];
      }
      if (!empty($requestFilters["search"])) {
         $search = $requestFilters["search"];
         $filters["search"] = [
            "title" => $search,
            "description" => $search
         ];
      }
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
