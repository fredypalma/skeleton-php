<?php declare(strict_types=1);

namespace CP\shared\domain\mailer;

final class Mailer
{
    /**
     * @param array $to
     * @param string $subject
     * @param string $htmlTemplate
     * @param array $context
     */
    public function __construct(
        private array  $to ,
        private string $subject ,
        private string $htmlTemplate ,
        private array  $context ,
    )
    {
    }

    /**
     * @return static
     */
    public static function create(): self
    {
        return new self([] , '' , '' , []);
    }

    /**
     * @param array $to
     * @param string $subject
     * @param string $template
     * @param array $context
     * @return void
     */
    public function setConfig(array $to , string $subject , string $template , array $context): void
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->htmlTemplate = $template;
        $this->context = $context;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return [
            $this->to ,
            $this->subject ,
            $this->htmlTemplate ,
            $this->context ,
        ];
    }
}