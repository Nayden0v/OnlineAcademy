<?php

namespace App\Providers;

use App\Models\User;
use App\Models\MenuItem;
use App\Models\Training;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Resources\StudentCollection;

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
        view()->share('trainings', Training::all());
        StudentCollection::withoutWrapping();
        View::composer('*', function ($view) {
            $trainings = Training::all();
            $menuItems = MenuItem::all();
            if (Auth::check()) {
                $user = Auth::user();
                $role = $user->role->name;
                if ($role === 'admin') {
                    $userMenuItems = $menuItems; // If admin, show all menu items
                } else {
                    $userMenuItems = $user->role->menuItems; // If not, only show assigned menu items
                }
                $view->with('userMenuItems', $userMenuItems);
            }
            $view->with('menuItems', $menuItems);
           $view->with('trainings', $trainings);
        });
    }
}
