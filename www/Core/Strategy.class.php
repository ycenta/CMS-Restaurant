<?php

namespace App\Core;


interface Strategy 
{
    public function write_logs(string $action, string $who, string $what=""): void;
}