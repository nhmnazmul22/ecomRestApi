<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
    public function findByEmail(string $email)
    {
        return $this->model->where("email", $email)->first();
    }
    public function findByRole(string $role){
       return $this->model->where("role", $role)->get();
    }
}
