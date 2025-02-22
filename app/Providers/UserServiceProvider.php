<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(UserService::class, function ($app) {
            $users = [
                [
                    'name' => 'John Doe',
                    'gender' => 'Male'
                ],
                [
                    'name' => 'Jane Doe',
                    'gender' => 'Female'
                ]
            ];
            return new UserService($users);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

?>