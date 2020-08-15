<?php

declare(strict_types=1);

use App\Controller\MainAction;
use Yiisoft\Router\Route;

return [
    Route::post('/', [MainAction::class, '__invoke'])->name('site/index'),
];
