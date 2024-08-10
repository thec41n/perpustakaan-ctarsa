<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Category;
use App\Policies\BookPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Book::class => BookPolicy::class,
        Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any authentication and authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Here you can define additional gates
        Gate::define('edit-book', function ($user, $book) {
            return $user->id === $book->user_id;
        });

        Gate::define('manage-categories', function ($user) {
            return $user->role === 'admin';
        });
    }
}
