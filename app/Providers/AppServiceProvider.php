<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
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
        // Note: Server timezone is now set to Asia/Jakarta in config/app.php
        // So all times are already in WIB, no conversion needed for Indonesian users
        
        // Register Blade directives for datetime display
        \Illuminate\Support\Facades\Blade::directive('formatDateTime', function ($expression) {
            return "<?php echo optional({$expression})->format('d M Y H:i') ?? '-'; ?>";
        });

        \Illuminate\Support\Facades\Blade::directive('formatDate', function ($expression) {
            return "<?php echo optional({$expression})->format('d M Y') ?? '-'; ?>";
        });

        \Illuminate\Support\Facades\Blade::directive('formatTime', function ($expression) {
            return "<?php echo optional({$expression})->format('H:i') ?? '-'; ?>";
        });

        // Share data to all views (for sidebar)
        View::composer('*', function ($view) {
            $user = auth()->user();
            
            if ($user) {
                $isGuru = $user->role === 'guru';
                
                // Filter classes based on user role
                if ($isGuru) {
                    // Guru: show all classes (or owned classes in the future)
                    $sidebarClasses = \App\Models\Kelas::orderBy('nama', 'asc')->limit(5)->get();
                    
                    // Upcoming tasks from all classes
                    $upcomingTasks = Tugas::with(['kelas'])
                        ->whereNotNull('deadline')
                        ->where('deadline', '>', now())
                        ->orderBy('deadline', 'asc')
                        ->limit(5)
                        ->get();
                } else {
                    // Siswa: only show enrolled classes (approved)
                    $sidebarClasses = $user->kelasAsSiswa()
                        ->orderBy('kelas.nama', 'asc')
                        ->limit(5)
                        ->get();
                    
                    // Upcoming tasks only from enrolled classes
                    $kelasIds = $sidebarClasses->pluck('id');
                    $upcomingTasks = Tugas::with(['kelas'])
                        ->whereIn('kelas_id', $kelasIds)
                        ->whereNotNull('deadline')
                        ->where('deadline', '>', now())
                        ->orderBy('deadline', 'asc')
                        ->get();
                    
                    // Add submission status for each task and filter out submitted tasks
                    $upcomingTasks = $upcomingTasks->filter(function($task) use ($user) {
                        $task->user_submission = \App\Models\Submission::where('tugas_id', $task->id)
                            ->where('user_id', $user->id)
                            ->latest('submitted_at')
                            ->first();
                        
                        // Only show tasks that haven't been submitted
                        return $task->user_submission === null;
                    })->take(5);
                }
                
                $view->with([
                    'upcomingTasks' => $upcomingTasks,
                    'sidebarClasses' => $sidebarClasses
                ]);
            } else {
                $view->with([
                    'upcomingTasks' => collect(),
                    'sidebarClasses' => collect()
                ]);
            }
        });
    }
}
