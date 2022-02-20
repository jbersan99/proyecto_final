<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ValoracionesController extends AbstractController
{
    /**
     * @Route("/valoraciones", name="valoraciones")
     */
    public function index(): Response
    {
        return $this->render('valoraciones/index.html.twig', [
            'controller_name' => 'ValoracionesController',
        ]);
    }
}
