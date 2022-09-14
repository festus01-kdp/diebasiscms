<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CounterStatistikController extends AbstractController
{
    public function showCounterStatistik(Request $request)
    {
        return $this->render('pages/counterstatistk.html.twig');
    }
}