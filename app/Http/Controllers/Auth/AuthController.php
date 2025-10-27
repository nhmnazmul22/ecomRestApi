<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Requests\AuthRequests\RegisterRequest;
use App\Http\Requests\AuthRequests\UpdateRequest;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{
   public function __construct(protected AuthServices $service)
   {
   }

   public function register(RegisterRequest $request)
   {
      try {
         $user = $this->service->register($request->validated());
         return $this->success($user, "User Registration successful", 201);
      } catch (Exception $e) {
         return $this->error($e->getMessage(), $e->getCode() ?? 500);
      }
   }

   public function login(LoginRequest $request)
   {
      try {
         $data = $request->validated();

         $response = $this->service->login($data["email"], $data["password"]);
         return $this->success($response, "Login Successful", 200);
      } catch (Exception $e) {
         return $this->error($e->getMessage(), $e->getCode());
      }
   }

   public function profile(Request $request)
   {
      try {
         $user = $this->service->getProfile();
         return $this->success($user, "Profile fetch successful", 200);
      } catch (Exception $e) {
         return $this->error($e->getMessage(), $e->getCode());
      }
   }

   public function update(UpdateRequest $request)
   {
      try {
         $user = $this->service->updateProfile($request->validated());
         return $this->success($user, "Profile update successful", 200);
      } catch (Exception $e) {
         return $this->error($e->getMessage(), $e->getCode());
      }
   }

   public function logout(Request $request)
   {
      try {
         $this->service->logout(auth()->user());
         return $this->success(null, "Logout successful", 200);
      } catch (Exception $e) {
         return $this->error($e->getMessage(), $e->getCode());
      }
   }
   public function getUsersByRole(Request $request)
   {
      try {
         $role = $request->query("role");
         $users = $this->service->getUsersByRole($role);
         return $this->success($users, "Users fetch successful", 200);
      } catch (Exception $e) {
         return $this->error($e->getMessage(), $e->getCode());
      }
   }
}
