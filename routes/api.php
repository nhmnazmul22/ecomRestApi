<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("/register", [AuthController::class, "register"])->name("auth.register");
Route::post("/login", [AuthController::class, "login"])->name("auth.login");

Route::middleware("auth:sanctum")->group(function () {
    Route::get("/profile", [AuthController::class, "profile"])->name("auth.profile");
    Route::put("/profile", [AuthController::class, "update"])->name("auth.update");
});
