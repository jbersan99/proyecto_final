<?php

namespace App\Controller;

use App\Entity\Reserva;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReservasType;
use App\Repository\ReservaRepository;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;

class ReservasController extends AbstractController
{
    /**
     * @Route("/reservas/{id}", name="reservas")
     */
    public function reservar(ManagerRegistry $doctrine, Request $request, int $id): Response
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
                'id' => $id,
                'form' => $form,
            ]);
        } else {
            return $this->redirectToRoute('barco');
        }
    }

    /**
     * @Route("/reservar_barco/{id}", name="reservar_barco")
     */
    public function reservar_barco(int $id, EntityManagerInterface $em): Response
    {
        $reserva = new Reserva();

        $reservas = $em->getRepository(Reserva::class)->findAll();

        $reserva = new stdClass();

        foreach ($reservas as $valor) {
            if ($valor->getBarcoReserva()->getId() == $id) {
                $objeto_fechas = new stdClass();
                $objeto_fechas->id = $valor->getId();
                $objeto_fechas->fecha_inicio = $valor->getFechaInicio();
                $objeto_fechas->fecha_fin = $valor->getFechaFin();

                $reserva->fechas[] = $objeto_fechas;
            }
        }

        $fechas_reservadas = json_encode($reserva);
        return new Response($fechas_reservadas);
    }

    /**                                                                                   
     * @Route("/reservar/{id}", name="reservar")
     */
    public function reserva(ManagerRegistry $doctrine, int $id, Request $request): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {
            // $barco = $doctrine->getRepository(Barco::class)->find($id);
            // $user = $this->get('security.token_storage')->getToken()->getUser();
            $reserva = new Reserva();

            $params = json_decode($request, true);

            $inicio = $params[0]->get('inicio');
            $fin = $params[0]->get('fin');

            $time = new \DateTime();

            $reserva->setFechaInicio($inicio);
            $reserva->setFechaFin($fin);
            $reserva->setCreacionReserva($time);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($reserva);
            $entityManager->flush();

            return new Response('This is ajax response');
        } else {
            return $this->redirectToRoute('barco');
        }
    }
}
