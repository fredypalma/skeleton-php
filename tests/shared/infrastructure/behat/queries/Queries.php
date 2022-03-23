<?php declare(strict_types=1);

namespace CP\Tests\shared\infrastructure\behat\queries;

final class Queries
{
    /**
     * @var array
     */
    private array $queries;

    private function __construct()
    {
        $this->queries = [];
    }

    /**
     * @return array
     */
    public static function getQueries(): array
    {
        $queries = new self();
        return $queries->get();
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->queries;
    }
}