<?php

namespace App\Controller;

use App\Entity\Reserva;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReservasType;

class ReservasController extends AbstractController
{
    /**
     * @Route("/reservas/{id}", name="reservas")
     */
    public function reservar(ManagerRegistry $doctrine, Request $request): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {
            $reserva = new Reserva();

            $form = $this->createForm(ReservasType::class, $reserva);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $reserva = $form->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($reserva);
                $entityManager->flush();

                return $this->redirectToRoute('barco');
            }

            return $this->renderForm('reservas/index.html.twig', [
                'form' => $form,
            ]);
        }
        else{
            return $this->redirectToRoute('barco');
        }
    }
}
