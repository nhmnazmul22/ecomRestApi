<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthServices
{
    public function __construct(protected UserRepository $repository) {}

    public function register(array $data): User
    {
        $exitsUser = $this->repository->findByEmail($data["email"]);
        if ($exitsUser) {
            throw new Exception("User Already Exits", 400);
        }

        $user = $this->repository->create($data);
        return $user;
    }

    public function login(string $email, string $password)
    {
        $user = $this->repository->findByEmail($email);
        $isValidPassword = Hash::check($password, $user->password);
        if (!$user || !$isValidPassword) {
            throw new Exception("Invalid credentials", 400);
        }

        $token = $user->createToken("auth_token")->plainTextToken;

        return [
            "user" => $user,
            "token" => $token,
        ];
    }

    public function logout(User $user)
    {
        $user->tokens()->delete();
        return true;
    }

    public function updateProfile(array $data)
    {
        return $this->repository->update(auth()->id(), $data);
    }

    public function getProfile()
    {
        return $this->repository->find(auth()->id());
    }
}
