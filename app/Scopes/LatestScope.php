<?php 
namespace App\Scopes;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LatestScope implements Scope
{
  public function apply(Builder $builder, Model $model)
  {
    // $builder->orderBy('created_at', 'desc');
    //hoặc viết ntn đều ok
    $builder->orderBy($model::CREATED_AT, 'desc');
  }
}
?>