<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseRepoInterface;


class BaseRepository implements BaseRepoInterface
{
   protected $model;
   public function __construct(Model $model)
   {
      $this->model = $model;
   }
   public function all($query = null)
   {
      if (!$query) {
         $query = $this->model->query();
      }
      return $query->get();
   }
   public function find(int $id, array $relations = [])
   {
      return $this->model->with($relations)->findOrFail($id);
   }
   public function create(array $data)
   {
      return $this->model->create($data);
   }
   public function update(int $id, array $data)
   {
      $record = $this->model->find($id);
      $record->update($data);
      return $record;
   }
   public function delete(int $id)
   {
      $record = $this->model->find($id);
      return $record->delete();
   }
}
