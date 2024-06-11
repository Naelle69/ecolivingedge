<?php

namespace App;

class AntiSpam
{
    public function alert(?string $message): bool {
        if ($message === null) {
            // je gére le cas où $message est null
            return false;
        }
        return strlen($message) < 10;
    }
}
