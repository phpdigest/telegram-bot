<?php

declare(strict_types=1);

use App\ApiClient\BackendApiClient;
use Psr\Container\ContainerInterface;
use Yiisoft\Aliases\Aliases;

/* @var array $params */

return [
    ContainerInterface::class => static function (ContainerInterface $container) {
        return $container;
    },

    Aliases::class => [
        '__class' => Aliases::class,
        '__construct()' => [$params['aliases']],
    ],
    BackendApiClient::class => [
        'class' => BackendApiClient::class,
        '__construct()' => [
            'uri' => $params['app']['api_url'],
        ],
    ],
];
