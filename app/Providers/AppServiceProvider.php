<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\ContactBook;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      Gate::define('view-contact', function ($user, ContactBook $contactBook) {
        return $user->id === $contactBook->user_id;
    });

    Gate::define('update-contact', function ($user, ContactBook $contactBook) {
        return $user->id === $contactBook->user_id;
    });

    Gate::define('delete-contact', function ($user, ContactBook $contactBook) {
        return $user->id === $contactBook->user_id;
    });
    }
}
