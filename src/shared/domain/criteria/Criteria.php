<?php declare(strict_types=1);

namespace CP\shared\domain\criteria;

final class Criteria
{
    /**
     * @param array $filters
     */
    public function __construct(private array $filters)
    {
    }

    /**
     * @param array $filters
     * @return static
     */
    public static function create(array $filters): self
    {
        return new self($filters);
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return $this->filters;
    }
}