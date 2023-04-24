<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class Comment extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function post() {
        return $this->belongsTo('App\Models\Post');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');   
    }

    
    public static function boot() {
        parent::boot();

        // static::addGlobalScope(new LatestScope);
    }
}
