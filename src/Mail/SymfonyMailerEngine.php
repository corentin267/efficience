<?php

declare(strict_types=1);

namespace App\Mail;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * MailEngine adapter using symfony mailer
 */
class SymfonyMailerEngine implements MailerEngineInterface
{
    private const FROM = 'efficience@gmail.com';

    public function __construct(private MailerInterface $mailer)
    {
    }

    /**
     * Function use to send mail
     * @throws TransportExceptionInterface
     */
    public function sendText(array $to, string $subject, string $body): void
    {
        $mail = (new Email())
            ->from(self::FROM)
            ->to(...$to)
            ->subject($subject)
            ->text($body);

        $this->mailer->send($mail);
    }
}