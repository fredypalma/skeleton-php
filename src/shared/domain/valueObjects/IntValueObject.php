<?php

namespace CP\shared\domain\valueObjects;

abstract class IntValueObject
{
    public function __construct(protected int $value)
    {
    }

    public function value(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}