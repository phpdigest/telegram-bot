<?php

declare(strict_types=1);

/* @var array $params */

use App\Provider\MiddlewareProvider;
use App\Provider\Psr17Provider;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;

return [
    'yiisoft/yii-web/psr17' => Psr17Provider::class,
    'yiisoft/yii-web/middleware' => MiddlewareProvider::class,

    ReverseBlockMerge::class => new ReverseBlockMerge(),
];
