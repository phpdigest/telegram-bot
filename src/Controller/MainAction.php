<?php

declare(strict_types=1);

namespace App\Controller;

use App\Conversation\SuggestLinkConversation;
use BotMan\BotMan\BotMan;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Yiisoft\Http\Status;

class MainAction
{
    private ResponseFactoryInterface $responseFactory;

    private BotMan $botMan;

    private StreamFactoryInterface $streamFactory;

    public function __construct(
        StreamFactoryInterface $streamFactory,
        ResponseFactoryInterface $responseFactory,
        BotMan $botMan
    ) {
        $this->responseFactory = $responseFactory;
        $this->botMan = $botMan;
        $this->streamFactory = $streamFactory;
    }

    public function __invoke()
    {
        $this->botMan->hears('/start', function (BotMan $bot) {
            $text = <<<TEXT
*Привет*.
Это бот для помощи сбора новостей из мира PHP для проекта [PHP Digest](https://phpdigest.ru).
TEXT;
            $bot->reply($text, [
                'parse_mode' => 'Markdown',
            ]);
        });
        $this->botMan->hears('/suggest', function (BotMan $bot) {
            $bot->startConversation(new SuggestLinkConversation());
        });

        $this->botMan->listen();

        return $this->responseFactory
            ->createResponse(Status::OK, Status::TEXTS[Status::OK])
            ->withBody($this->streamFactory->createStream('ok'))
            ;
    }
}
