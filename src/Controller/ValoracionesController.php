<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reserva;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReservasType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;


class ValoracionesController extends AbstractController
{
    /**
     * @Route("/valorar_reserva/{id}", name="valorar_reserva")
     */
    public function index(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        date_default_timezone_set("Europe/Madrid");
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')) {
            $reserva_fin = $doctrine->getRepository(Reserva::class)->find($id);
            $fecha_actual = date('Y-m-d');
            
            $fecha_fin = $reserva_fin->getFechaFin();

            $fecha_fin_formateada = $fecha_fin->format('Y-m-d');
                
            if($fecha_actual >= $fecha_fin_formateada && $reserva_fin->getValoracion() == null){
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
                    'id' => $id,
                ]); 
            }else{
                return $this->redirectToRoute('getreservas');
            }

            
        } else {
            return $this->redirectToRoute('barco');
        }
    }

    /**
     * @Route("/show_valoraciones", name="show_valoraciones")
     */
    public function show(EntityManagerInterface $em): Response
    {
        $reserva = new Reserva();

        $reservas = $em->getRepository(Reserva::class)->findAll();

        $reserva = new stdClass();

        foreach ($reservas as $valor) {
                $valoraciones = new stdClass();
                $valoraciones->valoracion = $valor->getValoracion();
                $valoraciones->comentario = $valor->getComentario();

                $reserva->valoraciones[] = $valoraciones;
        }

        $valoraciones_realizadas = json_encode($reserva);
        return new Response($valoraciones_realizadas);
    }

    /**                                                                                   
     * @Route("/getvaloraciones", name="getvaloraciones")
     */
    public function getReservas(ManagerRegistry $doctrine): Response
    {
            $user = $this->get('security.token_storage')->getToken()->getUser();

            return $this->render('valoraciones/show.html.twig', array(
                
            ));
        
    }
}
