<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Counter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CounterRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {

        $manager = $registry->getManager('customer');
        parent::__construct($registry, Counter::class);
/*
 * Fix from https://github.com/symfony/symfony-docs/issues/9878
 */
        EntityRepository::__construct($manager, $manager->getClassMetadata(Counter::class));
    }

}