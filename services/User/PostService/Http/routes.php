<?php

namespace Services\User\PostService\Http;

use Illuminate\Support\Facades\Route;
use Services\User\PostService\Http\Controllers\PostController;

Route::resource('posts', PostController::class)->middleware("jwt.auth");
