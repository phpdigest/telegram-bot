<?php

declare(strict_types=1);

/* @var array $params */

use App\Provider\FieldProvider;
use App\Provider\FlashProvider;
use App\Provider\I18nProvider;
use App\Provider\MailerInterfaceProvider;
use App\Provider\MiddlewareProvider;
use App\Provider\Psr17Provider;
use App\Provider\SessionProvider;
use App\Provider\SwiftSmtpTransportProvider;
use App\Provider\SwiftTransportProvider;
use App\Provider\ThemeProvider;
use App\Provider\WebViewProvider;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;
use Yiisoft\Yii\Event\EventDispatcherProvider;

return [
    'yiisoft/yii-web/psr17' => Psr17Provider::class,
    'yiisoft/yii-web/middleware' => MiddlewareProvider::class,
    'yiisoft/form/field' => [
        '__class' => FieldProvider::class,
        '__construct()' => [
            $params['yiisoft/form']['fieldConfig'],
        ],
    ],
    'yiisoft/view/webview' => [
        '__class' => WebViewProvider::class,
        '__construct()' => [
            $params['yiisoft/view']['basePath'],
            $params['yiisoft/view']['defaultParameters'],
        ],
    ],
    'yiisoft/event-dispatcher/eventdispatcher' => [
        '__class' => EventDispatcherProvider::class,
        '__construct()' => [$config['events-web']],
    ],

    ReverseBlockMerge::class => new ReverseBlockMerge(),
];
