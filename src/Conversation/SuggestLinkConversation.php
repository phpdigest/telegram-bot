<?php

declare(strict_types=1);

namespace App\Conversation;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

final class SuggestLinkConversation extends Conversation
{
    private string $suggest = '';

    public function askLink(): void
    {
        $str = <<<'TEXT'
Опишите то, что хотите предложить.
Можно добавлять ссылки и/или произвольный текст. Максимальная длина сообщения - 300 символов.
TEXT;
        $this->ask($str, function (Answer $answer) {
            $this->suggest = $answer->getText();

            $this->say('Спасибо. Мы обработаем ваше предложение.');
        });
    }

    public function run()
    {
        $this->askLink();
    }
}
