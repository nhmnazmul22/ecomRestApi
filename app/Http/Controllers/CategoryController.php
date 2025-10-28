<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequests\CategoryCreateRequest;
use App\Http\Requests\CategoryRequests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryServices;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

   public function __construct(protected CategoryServices $services)
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
            "search" => $request->query("search"),
         ];
         $categories = $this->services->getCategoriesList($filters);
         return $this->success($categories, "Categories data fetch successful", 200);
      } catch (Exception $e) {
         return $this->error($e->getMessage(), $e->getCode());
      }
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(CategoryCreateRequest $request)
   {
      try {
         $category = $this->services->create($request->validated());
         return $this->success($category, "Category create successful", 201);
      } catch (Exception $e) {
         return $this->error($e->getMessage(), $e->getCode());
      }
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(CategoryUpdateRequest $request, string $id)
   {
      try {
         $category = $this->services->update($id, $request->validated());
         return $this->success($category, "Categories updated successful", 200);
      } catch (Exception $e) {
         return $this->error($e->getMessage(), $e->getCode());
      }
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
      try {
         $this->services->delete($id);
         return $this->success(null, "Categories delete successful", 200);
      } catch (Exception $e) {
         return $this->error($e->getMessage(), $e->getCode());
      }
   }
}
