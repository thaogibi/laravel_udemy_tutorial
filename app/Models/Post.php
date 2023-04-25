<?php

namespace App\Models;

use App\Scopes\DeleteAdminScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];
    public function comments() {
        return $this->hasMany('App\Models\Comment')->latest();
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps()->as('tagged');   //->as('tagged'): nếu ko có -> thuộc tính xuất ra là pivot, nếu có thì xuất ra tagged
    }

    public function image() {
        return $this->hasOne('App\Models\Image');
    }
    //Local query
    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');   
    }

    public function scopeMostCommented(Builder $query)
    {
        // comments_count
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public function scopeLatesWithRelations(Builder $query)
    {
        // comments_count
        return $query->latest()
            ->withCount('comments')
            ->with('tags')
            ->with('user');
    }

    public static function boot() {
        //Global query
        static::addGlobalScope(new DeleteAdminScope);   //phải ở trên

        parent::boot();


        //Global query
        // static::addGlobalScope(new LatestScope);

        

        static::deleting(function (Post $post) {
            $post->comments()->delete();
            Cache::tags(['post'])->forget("post-{$post->id}");
        });


        static::updating(function (Post $post) {
            Cache::tags(['post'])->forget("post-{$post->id}");
        });


        static::restoring(function (Post $post) {
            $post->comments()->restore();
        });
    }
}
