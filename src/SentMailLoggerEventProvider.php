<?php

namespace SolveCase\SentMailLogger;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Event;
use SolveCase\SentMailLogger\Listeners\MessageSentListener;
use SolveCase\SentMailLogger\Listeners\MessageSentListenerOnQueue;

class SentMailLoggerEventProvider extends EventServiceProvider
{

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {

        if (config('imap.enabled')) {
            if (config('imap.queue')) {
                Event::listen(MessageSent::class, MessageSentListenerOnQueue::class);
            } else {
                Event::listen(MessageSent::class, MessageSentListener::class);
            }
        }

    }
}
