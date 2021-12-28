<?php

namespace CP\shared\domain\valueObjects;

abstract class StringValueObject
{

    public function __construct(protected string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}