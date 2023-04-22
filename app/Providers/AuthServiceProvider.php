<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy',
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

                
        
        // Viết gộp
        // Gate::resource('posts', 'App\Policies\PostPolicy');
            
            //Lệnh gộp trên thay cho các lệnh lẻ sau    
                // Gate::define('posts.update', 'App\Policies\PostPolicy@update');  // ~ Gate::define('posts.update', [PostPolicy::class, 'update']);
                // Gate::define('posts.delete', 'App\Policies\PostPolicy@delete');  // ~ Gate::define('posts.delete', [PostPolicy::class, 'delete']);
                //... ngoài ra còn create, view...





        Gate::before(function ($user, $ability) {
            if ($user->is_admin && in_array($ability, ['update', 'delete'])) {
                return true;
            }
        });
    }
}
