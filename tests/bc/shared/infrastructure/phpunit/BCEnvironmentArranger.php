<?php declare(strict_types=1);

namespace CP\Tests\bc\shared\infrastructure\phpunit;

use CP\Tests\shared\infrastructure\behat\queries\Queries;
use Doctrine\ORM\EntityManager;
use CP\Tests\shared\infrastructure\arranger\EnvironmentArranger;
use CP\Tests\shared\infrastructure\doctrine\MySqlDatabaseCleaner;
use function Lambdish\Phunctional\apply;

final class BCEnvironmentArranger implements EnvironmentArranger
{

    /**
     * @param EntityManager $BCEntityManager
     */
    public function __construct(private EntityManager $BCEntityManager)
    {
    }

    /**
     * @return void
     */
    public function arrange(): void
    {
        apply(new MySqlDatabaseCleaner(), [$this->BCEntityManager]);
    }

    /**
     * @return void
     */
    public function close(): void
    {
    }

    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function initQueries(): void
    {
        $conn = $this->BCEntityManager->getConnection();

        $queries = Queries::getQueries();

        foreach ($queries as $query) {
            $conn->executeQuery($query);
        }
    }
}