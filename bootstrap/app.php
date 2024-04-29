<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin.guest' => \App\Http\Middleware\AdminRedirect::class,
            'admin.auth' => \App\Http\Middleware\AdminAuthenticate::class,

            'secretary.auth' => \App\Http\Middleware\SecretaryAuthenticate::class,

            'teacher.auth' => \App\Http\Middleware\TeacherAuthenticate::class,
            
            'mentor.auth' => \App\Http\Middleware\MentorAuthenticate::class,

        ]);


    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();