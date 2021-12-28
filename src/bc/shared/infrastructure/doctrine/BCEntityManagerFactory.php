<?php

namespace CP\bc\shared\infrastructure\doctrine;

use Doctrine\ORM\EntityManagerInterface;
use CP\shared\infrastructure\doctrine\DoctrineEntityManagerFactory;

class BCEntityManagerFactory
{
    public static function create(array $parameters, string $environment): EntityManagerInterface
    {
        $isDevMode = 'prod' !== $environment;

        $prefixes = array_merge(
            DoctrinePrefixesSearcher::inPath(__DIR__ . '/../../../../bc', 'CP\bc')
        );

        $dbalCustomTypesClasses = DbalTypesSearcher::inPath(__DIR__ . '/../../../../bc', 'bc');

        return DoctrineEntityManagerFactory::create(
            $parameters,
            $prefixes,
            $isDevMode,
            $dbalCustomTypesClasses
        );
    }

}