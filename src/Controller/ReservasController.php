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
use stdClass;

class ReservasController extends AbstractController
{
    /**
     * @Route("/reservas/{id}", name="reservas")
     */
    public function reservar(ManagerRegistry $doctrine, Request $request, int $id, EntityManagerInterface $em): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {
            $reserva = new Reserva();

            $form = $this->createForm(ReservasType::class, $reserva);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {

                    $reservas = $em->getRepository(Reserva::class)->findAll();
        
                    $reserva = new stdClass();
                    $reserva->fech = [];
        
                    foreach ($reservas as $valor){
                        if($valor->getBarcoReserva()->getId() == $id){
                            $objeto_fechas = new stdClass();
                            $objeto_fechas->id = $valor->getId();
                            $objeto_fechas->fecha_inicio = $valor->getFechaInicio();
                            $objeto_fechas->fecha_fin = $valor->getFechaFin();
                            
                            $reserva->fechas[] = $objeto_fechas;
                        }

                    }
                    
                    $fin = json_encode($reserva);
                    return new Response($fin);
        
                }

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

    // /**
    //  * @Route("/comprobar_reserva", name="comprobar_reserva")
    //  */
    // public function comprobarReserva(EntityManagerInterface $em): Response
    // {
    //     if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {

    //         $reservas = $em->getRepository(Reserva::class)->findAll();

    //         $reserva = new stdClass();
    //         $reserva->fech = [];

    //         foreach ($reserva as $valor){

    //         }

    //         // if ($request->isXmlHttpRequest()) {
    //         //     $fecha_inicio = new \DateTime($request->request->get('fecha'));
    //         //     $fecha_fin = new \DateTime($request->request->get('fecha'));

    //         //     $repository = $em->getRepository(Reserva::class);

    //         //     $servicio = $repository->findBy(array('fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin));

    //         //     // $reserva = $repository->comprobarReserva($fecha_inicio, $fecha_fin);
    //         //     var_dump($servicio);
    //         // }
    //         // return $this->redirect($this->generateUrl('final'));
    //     }
    // }
}
