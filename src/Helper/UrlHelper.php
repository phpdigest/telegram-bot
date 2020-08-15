<?php

declare(strict_types=1);

namespace App\Helper;

final class UrlHelper
{
    public function validate(string $url)
    {
        if (strpos($url, '.') === false) {
            return false;
        }

        $url = $this->normalize($url);

        return preg_match('#^(?:https?://)?[\w\-.]+\.[\w]{2,10}/?.*?$#ui', $url);
    }

    public function normalize(string $url): string
    {
        if (stripos($url, 'http://') === false && stripos($url, 'https://') === false) {
            $url = 'https://' . $url;
        }

        return $url;
    }
}
