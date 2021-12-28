<?php

namespace CP\Tests\bc\shared\infrastructure\phpunit;

use BC\Backend\BCKernel;
use CP\Tests\shared\infrastructure\phpunit\InfrastructureTestCase;

abstract class BCContextInfrastructureTestCase extends InfrastructureTestCase
{
    private string $service;

    protected function setUp(): void
    {
        parent::setUp();

        $arranger = new BCEnvironmentArranger($this->service($this->service));

        $arranger->arrange();
    }

    protected function tearDown(): void
    {
        $arranger = new BCEnvironmentArranger($this->service($this->service));

        $arranger->close();

        parent::tearDown();
    }

    public function getEntityManager()
    {
        return $this->service($this->service);
    }

    protected function kernelClass(): string
    {
        $this->service = 'hc_doctrine_repository';
        return BCKernel::class;
    }

}