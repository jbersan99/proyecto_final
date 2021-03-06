<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Barco;
use App\Entity\Reserva;
use App\Form\BarcoType;
use Symfony\Component\HttpFoundation\JsonResponse;

class BarcoController extends AbstractController
{
    
    /**
     * @Route("/barco", name="barco")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $barcos = $doctrine->getRepository(Barco::class)->findAll();

        $reservas = $doctrine->getRepository(Reserva::class)->findAll();

        return $this->render('barco/index.html.twig', [
            'barcos' => $barcos,
            'reservas' => $reservas,
            'controller_name' => 'BarcoController',
        ]);
    }

    /**
     * @Route("/show_barcos", name="show_barcos")
     */
    public function mostrar_barcos(ManagerRegistry $doctrine): Response
    {
        $barcos = $doctrine->getRepository(Barco::class)->findAll();

        return $this->render('barco/show.html.twig', array(
            'barcos' => $barcos,
        ));
    }

    /**
     * @Route("/barco_info/{id}", name="barco_info")
     */
    public function info_barco(ManagerRegistry $doctrine, int $id): Response
    {
        $barco = $doctrine->getRepository(Barco::class)->find($id);

        return $this->render('barco/info.html.twig', array(
            'barco' => $barco,
        ));
    }


    /**
     * @Route("/barco_api_info/{id}", name="barco_api_info", methods={"GET"})
     */
    public function api_info(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $barco = $doctrine->getRepository(Barco::class)->find($id);

        $data = [
            'Nombre' => $barco->getNombre(),
            'Matricula' => $barco->getMatricula(),
            'Pasajeros' => $barco->getPasajerosMaximos(),
            'Precio con Patron' => $barco->getPrecioConPatron(),
            'Precio sin Patron' => $barco->getPrecioSinPatron(),
            'Eslora' => $barco->getEslora(),
            'Calado' => $barco->getCalado(),
            'Cubierta' => $barco->getCubierta(),
            'Caballos' => $barco->getCaballos(),
            'Licencia' => $barco->getLicencia(),
            'Latitud' => $barco->getLatitud(),
            'Longitud' => $barco->getLongitud(),
            'Patr??n' => $barco->getPatron()
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }
    

    /**
     * @Route("/new_barco", name="new_barco")
     */
    public function crear_barco(ManagerRegistry $doctrine, Request $request): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $barco = new Barco();

            $form = $this->createForm(BarcoType::class, $barco);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $barco = $form->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($barco);
                $entityManager->flush();

                return $this->redirectToRoute('show_barcos');
            }

            return $this->renderForm('barco/new.html.twig', [
                'form' => $form,
            ]);
        }
        if ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('barco');
        }
    }
}
