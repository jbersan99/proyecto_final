<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reserva;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReservasType;

class ValoracionesController extends AbstractController
{
    /**
     * @Route("/valorar_reserva/{id}", name="valorar_reserva")
     */
    public function index(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {
            $reserva = new Reserva();

            $form = $this->createForm(ReservasType::class, $reserva);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $reserva = $form->getData();

                $reserva_new = $doctrine->getRepository(Reserva::class)->find($id);

                $reserva_new->setValoracion($reserva->getValoracion());
                $reserva_new->setComentario($reserva->getComentario());
                $entityManager = $doctrine->getManager();
                $entityManager->persist($reserva_new);
                $entityManager->flush();

                return $this->redirectToRoute('getreservas');
            }

            return $this->renderForm('valoraciones/index.html.twig', [
                'form' => $form,
                'id' => $id
            ]);
        } else {
            return $this->redirectToRoute('barco');
        }
    }
}
