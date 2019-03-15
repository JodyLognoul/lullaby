<?php

declare(strict_types=1);

namespace App\Infrastructure\Share\Query\Repository;

use Doctrine\ORM\EntityManagerInterface;

abstract class MysqlRepository
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }
}
