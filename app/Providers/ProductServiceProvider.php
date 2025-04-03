<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Services\ProductService;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ProductService::class, function ($app) {
            $products = [
                [
                    'id' => 1,
                    'name' => 'Apple',
                    'category' => 'fruit',
                ],
                [
                    'id' => 2,
                    'name' => 'Brocolli',
                    'category' => 'Vegetable',
                ],
                [
                    'id' => 3,
                    'name' => 'Sardines',
                    'category' => 'Canned foods',
                ]
            ];

            return new ProductService($products);
            
        });
    }
    

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->share('productKey','abc123');
    }
}