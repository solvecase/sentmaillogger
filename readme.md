# SentMailLogger

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

Save a copy of laravel sent email in imap sent folder.

Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

```bash
composer require solvecase/sentmaillogger
```

## Prerequisite

-   laravel-framework >=9

-   php-imap extension

## Configuration

```
LOG_SENT_MESSAGE=true
LOG_ON_QUEUE=true
IMAP_PORT=993
IMAP_PROTOCOL="imap"
IMAP_ENCRYPTION="ssl"
IMAP_FOLDER="Sent"
IMAP_VALIDATE_CERT=true
IMAP_HOST="your-mail-host.com"
IMAP_USERNAME="email@example.com"
IMAP_PASSWORD="********"
```

`LOG_SENT_MESSAGE` enable/disable sent mail logger

`LOG_ON_QUEUE` implements _**Illuminate\Contracts\Queue\ShouldQueue**_

`IMAP_FOLDER` folder to be appended sent mail.

`IMAP_PROTOCOL`

-   `imap` &mdash; Use IMAP [default]
-   `pop3` &mdash; Use POP3
-   `nntp` &mdash; Use NNTP

`IMAP_ENCRYPTION`

-   `false` &mdash; Disable encryption
-   `ssl` &mdash; Use SSL [default]
-   `tls` &mdash; Use TLS
-   `starttls` &mdash; Use STARTTLS
-   `notls` &mdash; Use NoTLS

`IMAP_VALIDATE_CERT` validate certificates from TLS/SSL server

See more information on [PHP-IMAP][link-php-imap]

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email support@solvecase.com instead of using the issue tracker.

## Credits

-   [SolveCase][link-author]
-   [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/solvecase/sentmaillogger.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/solvecase/sentmaillogger.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/solvecase/sentmaillogger/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/727724863/shield
[link-packagist]: https://packagist.org/packages/solvecase/sentmaillogger
[link-downloads]: https://packagist.org/packages/solvecase/sentmaillogger
[link-travis]: https://travis-ci.org/solvecase/sentmaillogger
[link-styleci]: https://styleci.io/repos/727724863
[link-author]: https://github.com/solvecase
[link-contributors]: https://github.com/solvecase/sentmaillogger/graphs/contributors
[link-php-imap]: https://www.php.net/manual/en/book.imap.php
