<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ContactMessage; // استدعاء موديل الرسائل

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
        if (env('APP_ENV') !== 'local') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // هنا بنقول للارافيل ابعت المتغيرات دي تلقائياً لملف الماستر بتاع الأدمن
        View::composer('*', function ($view) {
            $view->with([
                'unreadCount'           => ContactMessage::where('is_read', false)->count(),
                'notificationsMessages' => ContactMessage::where('is_read', false)->latest()->take(5)->get()
            ]);
        });
    }
}