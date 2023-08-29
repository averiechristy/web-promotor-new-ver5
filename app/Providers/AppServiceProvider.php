<?php

namespace App\Providers;

use App\Models\ContactUs;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Validator;
use View;

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
        Paginator::useBootstrap();
        // app/Providers/AppServiceProvider.php

        view()->composer(['admin.contact-us.index', 'admin.contact-us.show'], function ($view) {
            $unreadContacts = ContactUs::where('read', false)->get();
            $unreadCount = $unreadContacts->count();
            $view->with(compact('unreadContacts', 'unreadCount'));
        });

        view()->composer('components.admin.navbar', function ($view) {
            $unreadContacts = ContactUs::where('read', false)->count();
            $view->with('unreadContacts', $unreadContacts);
        });

       
Validator::extend('unique_per_role', function ($attribute, $value, $parameters, $validator) {
    [$nameColumn, $roleColumn, $roleValue] = $parameters;

    $count = Product::where($nameColumn, $value)
        ->where($roleColumn, $roleValue)
        ->count();

    return $count === 0;
});

        
        

    }

    
}
