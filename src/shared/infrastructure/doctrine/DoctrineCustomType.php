<?php

namespace CP\shared\infrastructure\doctrine;

interface DoctrineCustomType
{
    public function customTypeName(): string;
}