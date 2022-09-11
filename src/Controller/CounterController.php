<?php

namespace App\Controller;

use App\Entity\Counter;
use Doctrine\Persistence\ManagerRegistry;

use Sulu\Bundle\WebsiteBundle\Controller\DefaultController;
use Sulu\Component\Content\Compat\StructureInterface;
use Symfony\Component\HttpFoundation\Response;

class CounterController extends DefaultController
{

    public function indexMyAction(StructureInterface $structure, ManagerRegistry $doctrine): Response
    {

        $clientIp = $this->container->get('request_stack')->getCurrentRequest()->getClientIp();
        $host =  $this->container->get('request_stack')->getCurrentRequest()->getHttpHost();
        $jetzt = date_create('now')->add(new \DateInterval('PT2M'));

        $counter = $doctrine->getManager('customer')->getRepository(Counter::class)->findOneBy(['clientIp' => $clientIp],['datetime' => 'DESC']);
        if($counter){
            $dateDb = $doctrine->getManager('customer')->getRepository(Counter::class)->findOneBy(['clientIp' => $clientIp],['datetime' => 'DESC']);
            if($this->getTimeMinutesDifferenz($jetzt, $dateDb->getDatetime(), 2))
            {
                $counter->setZaehler($counter->getZaehler() + 1);
                $counter->setDatetime($jetzt);
                $counter->setPage($structure->getView());
                $counter->setHost($host);
                $this->updateCounter($doctrine,$counter);
            }
        } else
        {
            $this->addCounter($structure, $doctrine, $jetzt, $clientIp, $host);
        }

        return parent::indexAction($structure, $preview = false, $partial = false);

    }

    protected function addCounter(StructureInterface $structure, ManagerRegistry $doctrine, \DateTime $jetzt, string $ip, string $host)
    {

        $entityManager = $doctrine->getManager('customer');

        $counter = (new Counter)
            ->setPage($structure->getView())
            ->setZaehler(1)
            ->setDatetime($jetzt)
            ->setHost($host)
            ->setClientIp($ip);

        $entityManager->persist($counter);

        $entityManager->flush();

    }

    protected function updateCounter(ManagerRegistry $doctrine, Counter $counter)
    {
        $doctrine->getManager('customer')->flush();
    }

    protected function getTimeMinutesDifferenz(\DateTime $date1, \DateTime $date2, int $minDiff): bool
    {
        $differenz = $date1->diff($date2);

        $minuten = $differenz->days * 24* 60;
        $minuten += $differenz->h * 60;
        $minuten += $differenz->i;

        return $minuten >= $minDiff;
    }



}
