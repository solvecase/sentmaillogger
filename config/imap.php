<?php

return [
    'enabled' => env('LOG_SENT_MESSAGE', false),
    'queue' => env('LOG_ON_QUEUE', false),
    'host' => env('IMAP_HOST'),
    'port' => env('IMAP_PORT', 993),
    'protocol' => env('IMAP_PROTOCOL', 'imap'),
    'encryption' => env('IMAP_ENCRYPTION', 'ssl'),
    'folder' => env('IMAP_FOLDER', 'Sent'),
    'username' => env('IMAP_USERNAME'),
    'password' => env('IMAP_PASSWORD'),
    'validate_cert' => env('IMAP_VALIDATE_CERT', true),
];
