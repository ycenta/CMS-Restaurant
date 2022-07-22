<?php

namespace App\Core;

use App\Model\Log;

class ConcreteStrategyUser implements Strategy
{
    public function write_logs(string $action, string $who, string $what=""): void
    {
        $log = Log::getInstance();
        date_default_timezone_set('UTC');
        fwrite($log->getUsersFile(), "New user " . $action . " -> " . $who . " - " . date('D, d-m-Y H:i:s') . "\n");
    }
}