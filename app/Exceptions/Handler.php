<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            
            // if ($e->errorInfo[1] == 1049) {
            //     // dd($e->errorInfo[1]);
            //     // dd("BENAR");
            //     Artisan::call('migrate', ['--seed' => true]);
            //     // return redirect()->back()->with('message', 'Database has been migrated and seeded successfully.');
            // }
        });
    }
}
