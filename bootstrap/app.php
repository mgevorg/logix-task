<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->bind(
    Services\User\AuthService\Contracts\AuthServiceInterface::class,
    Services\User\AuthService\ServiceCore\AuthService::class,
);
$app->bind(
    'services.user.auth-service',
    Services\User\AuthService\Contracts\AuthServiceInterface::class
);
$app->bind(
    Services\User\PostService\Contracts\PostServiceInterface::class,
    Services\User\PostService\ServiceCore\PostService::class,
);
$app->bind(
    'services.user.post-service',
    Services\User\AuthService\Contracts\AuthServiceInterface::class
);

$app->bind(
    Services\User\AuthService\Contracts\PasswordServiceInterface::class,
    Services\User\AuthService\ServiceCore\PasswordService::class,
);
$app->bind(
    'services.user.password-service',
    Services\User\AuthService\Contracts\PasswordServiceInterface::class,
);


/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
