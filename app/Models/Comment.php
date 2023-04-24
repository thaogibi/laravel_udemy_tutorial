<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id'
    ];
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

        static::creating(function (Comment $comment) {
            Cache::tags(['post'])->forget("post-{$comment->post_id}");
            Cache::tags(['post'])->forget('mostCommented');
        });

        // static::addGlobalScope(new LatestScope);
        
    }
}
