<?php

declare(strict_types=1);

namespace App\Telegram\Command;

use App\Telegram\Conversation\SuggestLinkConversation;
use BotMan\BotMan\BotMan;

final class SuggestLinkCommand implements CommandInterface
{
    private SuggestLinkConversation $suggestLinkConversation;

    public function __construct(SuggestLinkConversation $suggestLinkConversation)
    {
        $this->suggestLinkConversation = $suggestLinkConversation;
    }

    public static function getName(): string
    {
        return 'suggest_link';
    }

    public function handle(BotMan $botMan)
    {
        $botMan->startConversation($this->suggestLinkConversation);
    }
}
