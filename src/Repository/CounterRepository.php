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

    private function getSumZaehler()
    {

        $query = $this->_em->createQuery(
            "SELECT SUM(c.zaehler) summe from App\Entity\Counter c"
            ." WHERE c.id != 1"
        );

        return $query->getResult()[0]['summe'];

    }
//
    private function getCounterGroupBy()
    {
        $query = $this->_em->createQuery(
            "SELECT c.page, SUM(c.zaehler) summe FROM App\Entity\Counter c"
            ." WHERE c.id != 1"
            ."GROUP BY c.page"
        );

        return $query->getResult();
    }
//
    public function getDataFromCounter():array
    {

        $returnArray = [];
        $pages = $this->getCounterGroupBy();

        $sumAccess = $this->getSumZaehler();

        $query = $this->findBy([],['datetime' => 'ASC'],[1]);
        $firstAccess = $query[0]->getDatetime()->getTimestamp();

        $query = $this->findBy([],['datetime' => 'DESC'],[1]);
        $lastAccess = $query[0]->getDatetime()->getTimestamp();



        $returnArray = [
            'sumAccess' => $sumAccess,
            'lastAccess' => date('d.m.Y', $lastAccess),
            'firstAccess' => date('d.m.Y', $firstAccess),
            'pages' => $pages,
            ];
//        Zusätzlichen Eintrag einfügen
//        $returnArray['V2'] = 2;

        return $returnArray;

    }

}