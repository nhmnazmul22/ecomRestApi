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
      // dd($relations);
      $query = $this->model->with($relations);

      if (isset($filters["status"])) {
         $this->model->where("status", $filters["status"]);
      }

      if (isset($filters["from"]) && isset($filters["to"])) {
         $from = Carbon::parse($filters["from"])->startOfDay();
         $to = Carbon::parse($filters["to"])->endOfDay();
         $this->model->query()->whereBetween("created_at", [$from, $to]);
      }

      if (isset($filters["search"])) {
         $search = $filters["search"];
         $this->model->query()->whereAny(["name", "description"], "like", "%{$search}%");
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
