<?php

namespace App\Repositories\Interfaces;

interface BaseRepoInterface
{
   public function all(array $filters, array $relations = []);
   public function find(string $column, string|int $value, array $relations = []);
   public function create(array $data);
   public function update(int $id, array $data);
   public function delete(int $id);
}
