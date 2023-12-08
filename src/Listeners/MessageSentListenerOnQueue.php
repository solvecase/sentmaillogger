<?php

namespace SolveCase\SentMailLogger\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use SolveCase\SentMailLogger\Facades\SentMailLogger;

class MessageSentListenerOnQueue implements ShouldQueue
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
