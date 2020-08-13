<?php

declare(strict_types=1);

namespace App\Controller;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Yiisoft\DataResponse\DataResponseFactoryInterface;

class SiteController
{
    public function index(DataResponseFactoryInterface $responseFactory)
    {
        $config = [
            // Your driver-specific configuration
            "telegram" => [
                "token" => "TOKEN",
            ],
        ];

// Load the driver(s) you want to use
        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

// Create an instance
        $botman = BotManFactory::create($config);

// Give the bot something to listen for.
        $botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hello yourself.');
        });

// Start listening
        $botman->listen();

        return $responseFactory->createResponse();
    }
}
