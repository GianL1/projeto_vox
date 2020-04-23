<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SocioController extends AbstractController
{
    /**
     * @Route("/socio", name="socio")
     */
    public function index()
    {
        return $this->render('socio/index.html.twig', [
            'controller_name' => 'SocioController',
        ]);
    }
}
