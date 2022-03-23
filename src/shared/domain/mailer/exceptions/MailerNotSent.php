<?php declare(strict_types=1);

namespace CP\shared\domain\mailer\exceptions;

use CP\shared\domain\DomainError;

final class MailerNotSent extends DomainError
{
    /**
     * @var string
     */
    private string $errorOriginal;

    /**
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->errorOriginal = $message;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function errorCode(): string
    {
        return '452';
    }

    /**
     * @return string
     */
    public function errorMessage(): string
    {
        return 'No fue posible enviar el correo : ' . $this->errorOriginal;
    }
}