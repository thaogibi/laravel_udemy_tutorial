<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\PostPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-post', function($user, $post) {
        //     return $user->id == $post->user_id;
        // });

        // Gate::define('delete-post', function($user, $post) {
        //     return $user->id == $post->user_id;
        // });

        
        // Gate::define('posts.update', 'App\Policies\PostPolicy@update');
        // Gate::define('posts.delete', 'App\Policies\PostPolicy@delete');

        // Gate::define('posts.update', [PostPolicy::class, 'update']);
        // Gate::define('posts.delete', [PostPolicy::class, 'delete']);

        Gate::resource('posts', 'App\Policies\PostPolicy');

        // Gate::before(function ($user, $ability) {
        //     if($user->is_admin && in_array($ability,['posts.update', 'posts.delete'])) {
        //         return true;
        //     }
        // });
    }
}
