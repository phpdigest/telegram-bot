<?php

declare(strict_types=1);

namespace App\Telegram\Conversation;

use App\Helper\UrlHelper;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

final class SuggestLinkConversation extends Conversation
{
    protected string $link = '';

    protected string $description = '';

    protected UrlHelper $urlHelper;

    public function __construct(UrlHelper $urlValidator)
    {
        $this->urlHelper = $urlValidator;
    }

    public function askLink(): void
    {
        $str = <<<TEXT
Введите ссылку
TEXT;
        $this->ask($str, function (Answer $answer) {
            $this->link = $this->urlHelper->normalize($answer->getText());

            if (!$this->urlHelper->validate($this->link)) {
                $this->say('Ошибка. Ссылка не распознана.');

                return;
            }

            $this->askDescription();
        });
    }

    public function askDescription(): void
    {
        $str = <<<TEXT
Опишите то, что хотите предложить.
Можно добавлять ссылки и/или произвольный текст. Максимальная длина сообщения - 300 символов.
TEXT;
        $this->ask($str, function (Answer $answer) {
            $this->description = $answer->getText();

            $this->say('Спасибо. Мы обработаем ваше предложение.');

            $quote = <<<MARKDOWN
Ссылка: `{$this->link}`

Описание:
```
{$this->description}
```
MARKDOWN;

            $this->say($quote, [
                'parse_mode' => 'Markdown',
            ]);
        });
    }

    public function run()
    {
        $this->askLink();
    }
}