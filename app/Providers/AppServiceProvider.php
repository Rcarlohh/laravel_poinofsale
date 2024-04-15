<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Método para registrar cualquier servicio en el contenedor de servicios
    }

    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('currentUser', Auth::user());
        });
    }
}
