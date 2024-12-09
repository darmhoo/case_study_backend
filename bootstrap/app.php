<?php

use App\Services\GetNewsDataServices;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\DB;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->call(function () {
            DB::table('articles')->delete();
            $po = new GetNewsDataServices();
            $po->bbcNews();
            $po->newsApiOrg();
            $po->newYorkTimes();
        })->everyFiveMinutes();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
