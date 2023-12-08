<?php

namespace SolveCase\SentMailLogger\Facades;

use Illuminate\Support\Facades\Facade;

class SentMailLogger extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'sentmaillogger';
    }
}
