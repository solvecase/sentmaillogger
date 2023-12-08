<?php

namespace SolveCase\SentMailLogger;

use Exception;
use IMAP\Connection;

class SentMailLogger
{

    private $imapStream;

    private $mailbox;

    public function __construct()
    {
    }

    public function __destruct()
    {
        if ($this->hasImapStream()) {
            imap_close($this->imapStream);
        }
    }

    public function logSentMail($message)
    {
        if (!$this->hasImapStream()) {
            $this->openImapStream();
        }
        imap_append($this->imapStream, $this->getMailBox(), $message);
    }

    private function hasImapStream(): bool
    {
        return (is_resource($this->imapStream) || $this->imapStream instanceof Connection) && imap_ping($this->imapStream);
    }

    private function openImapStream(): void
    {
        $mailbox = $this->getMailBox();
        $user = $this->getUser();
        $password = $this->getPassword();
        try {
            $this->imapStream = imap_open($mailbox, $user, $password, OP_HALFOPEN);
        } catch (Exception) {
            throw new Exception(imap_last_error());
        }
    }

    private function getMailBox()
    {
        if (empty($this->mailbox)) {
            $host = $this->getHost();
            $port = config('imap.port');
            $protocol = $this->getProtocol();
            $encryption = $this->getEncryption();
            $validate_cert = config('imap.validate_cert') ? '/validate-cert' : '/novalidate-cert';
            $folder = imap_utf7_encode(config('imap.folder'));
            $this->mailbox = "{" . $host . ":" . $port . $protocol . $encryption . $validate_cert . "}" . $folder;
        }

        return $this->mailbox;
    }

    private function getHost()
    {
        return tap(config('imap.host'), function ($host) {
            if (empty($host)) {
                throw new Exception("IMAP_HOST has not been specified in .env");
            }
        });
    }

    private function getUser()
    {
        return tap(config('imap.username'), function ($username) {
            if (empty($username)) {
                throw new Exception("IMAP_USERNAME has not been specified in .env");
            }
        });
    }

    private function getPassword()
    {
        return tap(config('imap.password'), function ($password) {
            if (empty($password)) {
                throw new Exception("IMAP_PASSWORD has not been specified in .env");
            }
        });
    }

    private function getEncryption()
    {
        if (!config('imap.encryption') || empty(config('imap.encryption'))) {
            return '';
        }
        return tap('/' . config('imap.encryption'), function ($encryption) {
            $valids = ['/ssl', '/tls', '/starttls', '/notls'];
            if (!in_array($encryption, $valids)) {
                throw new Exception("IMAP_ENCRYPTION " . config('imap.encryption') . " is not supported.");
            }
        });
    }

    private function getProtocol()
    {
        return tap('/' . config('imap.protocol'), function ($protocol) {
            $valids = ['/imap', '/pop3', '/nntp'];
            if (!in_array($protocol, $valids)) {
                throw new Exception("IMAP_ENCRYPTION " . config('imap.protocol') . " is not supported.");
            }
        });
    }
}
