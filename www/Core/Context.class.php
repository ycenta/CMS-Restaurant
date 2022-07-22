<?php

namespace App\Core;


class Context
{
    private $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy(string $action, string $who, string $what=""): void
    {
        $this->strategy->write_logs($action, $who, $what);
    }
}