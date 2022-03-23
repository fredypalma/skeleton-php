<?php declare(strict_types=1);

namespace CP\shared\domain\mailer\services;

use CP\shared\domain\mailer\Mailer;
use CP\shared\domain\mailer\MailerRepository;

final class SendEmail
{
    /**
     * @param MailerRepository $emailRepository
     */
    public function __construct(private MailerRepository $emailRepository)
    {
    }

    /**
     * @param Mailer $email
     * @return void
     */
    public function __invoke(Mailer $email): void
    {
        $this->emailRepository->send($email);
    }
}