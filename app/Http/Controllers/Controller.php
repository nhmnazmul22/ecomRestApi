<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
   protected function success($data, $message = "success", int $status = 200): JsonResponse
   {
      return response()->json([
         "status" => "success",
         "message" => $message,
         "data" => $data
      ], $status);
   }

   protected function error($message = "error", $status = 400)
   {
      return response()->json([
         "status" => "error",
         "message" => $message
      ], $status);
   }
}
