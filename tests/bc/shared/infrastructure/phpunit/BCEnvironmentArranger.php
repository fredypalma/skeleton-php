<?php

namespace CP\Tests\bc\shared\infrastructure\phpunit;

use Doctrine\ORM\EntityManager;
use CP\Tests\shared\infrastructure\arranger\EnvironmentArranger;
use CP\Tests\shared\infrastructure\doctrine\MySqlDatabaseCleaner;
use function Lambdish\Phunctional\apply;

final class BCEnvironmentArranger implements EnvironmentArranger
{

    public function __construct(private EntityManager $HCEntityManager)
    {
    }

    public function arrange(): void
    {
        apply(new MySqlDatabaseCleaner(), [$this->HCEntityManager]);
    }

    public function close(): void
    {
    }
}