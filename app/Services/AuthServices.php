<?php

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthServices
{
    public function __construct(protected UserRepository $repository) {}

    public function register(array $data): User
    {
        $exitsUser = $this->repository->findByEmail($data["email"]);
        if ($exitsUser) {
            throw new Exception("User Already Exits");
        }

        $user = $this->repository->create($data);
        return $user;
    }

    public function login(string $email, string $password)
    {
        $user = $this->repository->findByEmail($email);
        $isValidPassword = Hash::check($password, $user->password);
        if (!$user || !$isValidPassword) {
            throw new Exception("Invalid credentials");
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

    public function updateProfile(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function getProfile(int $id)
    {
        return $this->repository->find($id);
    }
}
