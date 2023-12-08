<?php

namespace SolveCase\SentMailLogger\Listeners;

use Illuminate\Mail\Events\MessageSent;
use SolveCase\SentMailLogger\Facades\SentMailLogger;

class MessageSentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageSent  $event
     * @return void
     */
    public function handle(MessageSent $event): void
    {
        SentMailLogger::logSentMail($event->sent->getSymfonySentMessage()->toString());
    }
}
