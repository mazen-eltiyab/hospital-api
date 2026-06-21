<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // 1. هنا تعريف الـ Aliases الخاصة بالأدوار اللي أنت عاملها للمستشفى
        $middleware->alias([
            'admin'   => \App\Http\Middleware\AdminMiddleware::class,
            'doctor'  => \App\Http\Middleware\DoctorMiddleware::class,
            'patient' => \App\Http\Middleware\PatientMiddleware::class,
        ]);

        // 2. هنا تسجيل الـ SetLocale داخل الـ web عشان يشتغل تلقائياً على كل الصفحات
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);
        
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e) {
            return response("<pre>" . (string) $e . "</pre>", 500);
        });
    })
    ->create();