<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\EloquentCategoryRepository;
use App\Repositories\EloquentDepartmentRepository;
use App\Repositories\EloquentInvoiceRepository;
use App\Repositories\EloquentProductRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Repositories\EloquentUserRepository;

use App\Repositories\BrandRepository;
use App\Repositories\EloquentBrandRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(BrandRepository::class, EloquentBrandRepository::class);
        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);
        $this->app->bind(ProductRepository::class, EloquentProductRepository::class);
        $this->app->bind(DepartmentRepository::class, EloquentDepartmentRepository::class);
        $this->app->bind(InvoiceRepository::class, EloquentInvoiceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
