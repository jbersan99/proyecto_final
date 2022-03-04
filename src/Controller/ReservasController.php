<?php

namespace App\Controller;

use App\Entity\Reserva;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReservasType;
use App\Entity\Barco;
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
    public function reserva(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {
            $barco = $doctrine->getRepository(Barco::class)->find($id);
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $reserva = new Reserva();

            $patron = $request->get('patron');
            $inicio = $request->get('inicio');
            $fin = $request->get('fin');

            $inicio_day = explode("-", $inicio);
            $fin_day = explode("-", $fin);

            $interval = $fin_day[2] - $inicio_day[2];
            
            if($patron == "si"){
                $reserva->setPrecioTotal(($interval+1) * $barco->getPrecioConPatron());
            }else{
                $reserva->setPrecioTotal(($interval+1) * $barco->getPrecioSinPatron());
            }
            
            $time = new \DateTime();

            $reserva->setBarcoReserva($barco);
            $reserva->setUsuarioReserva($user);
            $reserva->setFechaInicio(\DateTime::createFromFormat('Y-m-d', $inicio));
            $reserva->setFechaFin(\DateTime::createFromFormat('Y-m-d', $fin));
            $reserva->setCreacionReserva($time);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($reserva);
            $entityManager->flush();

            return new Response('/getreservas');
        } else {
            return $this->redirectToRoute('barco');
        }

    }

    /**                                                                                   
     * @Route("/getreservas", name="getreservas")
     */
    public function getReservas(ManagerRegistry $doctrine): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $reservas = $doctrine->getRepository(Reserva::class)->getReservas(['usuario_reserva_id' => $user->getId()]);

            return $this->render('reservas/show.html.twig', array(
                'reservas' => $reservas,
            ));
        } else {
            return $this->redirectToRoute('barco');
        }
    }

    /**                                                                                   
     * @Route("/eliminar_reserva/{id}", name="delete_reserva")
     */
    public function deleteReserva(ManagerRegistry $doctrine, int $id): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {
            $reserva = $doctrine->getRepository(Reserva::class)->find($id);
            $entityManager = $doctrine->getManager();
            $entityManager->remove($reserva);
            $entityManager->flush();

            return $this->redirectToRoute('getreservas');
        } else {
            return $this->redirectToRoute('barco');
        }
    }
}
