<?php

namespace App\Controller;

use App\Entity\Reserva;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReservasType;
use Doctrine\ORM\EntityManagerInterface;

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
        } else {
            return $this->redirectToRoute('barco');
        }
    }

    /**
     * @Route("/comprobar_reserva", name="comprobar_reserva")
     */
    public function comprobarReserva(Request $request, EntityManagerInterface $em)
    {
        if ($request->isXmlHttpRequest()) {
            $fecha_inicio = new \DateTime($request->request->get('fecha'));
            $fecha_fin = new \DateTime($request->request->get('fecha'));

            $repository = $em->getRepository(Reserva::class);

            $reserva = $repository->comprobarReserva($fecha_inicio, $fecha_fin);
            var_dump($reserva);
            return new Response($reserva);
        }
        return $this->redirect($this->generateUrl('final'));
    }
}
