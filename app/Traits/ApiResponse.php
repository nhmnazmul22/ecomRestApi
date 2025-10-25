<?php

namespace App\Traits;


trait ApiResponse
{
    protected function success($data, $message = "success", $status = 200)
    {
        return response()->json([
            "status" => "success",
            "message" => $message,
            "data" => $data
        ]);
    }

    protected function error($message = "error", $status = 400)
    {
        return response()->json([
            "status" => "error",
            "message" => $message
        ]);
    }
}
