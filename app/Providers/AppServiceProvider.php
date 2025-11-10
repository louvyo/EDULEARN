<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Tugas;

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
        // Share data to all views (for sidebar)
        View::composer('*', function ($view) {
            // Upcoming tasks
            $upcomingTasks = Tugas::with(['kelas'])
                ->whereNotNull('deadline')
                ->where('deadline', '>', now())
                ->orderBy('deadline', 'asc')
                ->limit(5)
                ->get();
            
            // Sidebar classes (limit to 3, ordered by name)
            $sidebarClasses = \App\Models\Kelas::orderBy('nama', 'asc')->limit(3)->get();
            
            $view->with([
                'upcomingTasks' => $upcomingTasks,
                'sidebarClasses' => $sidebarClasses
            ]);
        });
    }
}
