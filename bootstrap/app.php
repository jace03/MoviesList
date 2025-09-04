<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

const WEB_ROUTES_PATH = __DIR__ . '/../routes/web.php';
const CONSOLE_ROUTES_PATH = __DIR__ . '/../routes/console.php';
const API_ROUTES_PATH = __DIR__ . '/../routes/api.php';
const HEALTH_CHECK_PATH = '/up';

function configureApplication(): Application
{
    return Application::configure(basePath: dirname(__DIR__))
        ->withRouting(
            web: WEB_ROUTES_PATH,
            api: API_ROUTES_PATH,
            commands: CONSOLE_ROUTES_PATH,
            health: HEALTH_CHECK_PATH,
        )
        ->withMiddleware(function (Middleware $middleware) {
            // Register global middleware here
        })
        ->withExceptions(function (Exceptions $exceptions) {
            // Register exception handling logic here
        })
        ->create();
}

return configureApplication();
