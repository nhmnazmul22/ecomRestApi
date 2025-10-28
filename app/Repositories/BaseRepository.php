<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseRepoInterface;


class BaseRepository implements BaseRepoInterface
{
   protected $model;
   public function __construct(Model $model)
   {
      $this->model = $model;
   }
   public function all($filters = [], $relations = [])
   {
      $query = $this->model->with($relations);

      foreach ($filters as $key => $value) {
         if ($key === "search" && !empty($value)) {
            $query->where(function ($q) use ($value) {
               foreach ($value as $field => $term) {
                  $q->orWhere($field, "like", "%{$term}%");
               }
            });
         } elseif (is_array($value) && (isset($value["from"]) || isset($value["to"]))) {
            if (!empty($value["from"]) && !empty($value["to"])) {
               $query->whereBetween($key, [$value["from"], $value["to"]]);
            } elseif (!empty($value["from"])) {
               $query->where($key, ">=", $value["from"]);
            } elseif (!empty($value["to"])) {
               $query->where($key, "<=", $value["to"]);
            }
         } else {
            $query->where($key, $value);
         }
      }

      return $query->get();
   }
   public function find(string $column, string|int $value, array $relations = [])
   {
      return $this->model->with($relations)->where($column, $value)->first();
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
