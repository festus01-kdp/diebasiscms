<?php

namespace App\Controller;

use App\Entity\Counter;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CounterStatistikController extends AbstractController
{

    protected $doctrine;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->doctrine = $registry;
    }

    public function showCounterStatistik()
    {
        $data = $this->doctrine->getManager('customer')->getRepository(Counter::class)->getDataFromCounter();

        return $this->render('pages/counterstatistik.html.twig', [
            'content' => ['counter' => $data],
        ]);
    }
}