<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Services\ProductServices;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{

   public function __construct(protected ProductServices $services)
   {

   }

   /**
    * Display a listing of the resource.
    */
   public function index(Request $request)
   {
      try {
         $filters = [
            "status" => $request->query("status"),
            "from" => $request->query("from"),
            "to" => $request->query("to"),
            "from_price" => $request->query("from_price"),
            "to_price" => $request->query("to_price"),
            "from_stock" => $request->query("from_stock"),
            "to_stock" => $request->query("to_stock"),
            "search" => $request->query("search"),
         ];
         $products = $this->services->getProducts($filters);
         return $this->success(ProductResource::collection($products), "Product fetch successful", 200);
      } catch (Exception $e) {
         return $this->error($e->getMessage(), $e->getCode());
      }
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      //
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, string $id)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
      //
   }
}
