<?php

namespace App\Controller;

use App\Repository\HousesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HousesController extends AbstractController
{
    /**
     * @Route("/houses", name="houses")
     */
    public function index(HousesRepository $housesRepository): Response
    {
        $houses = $housesRepository->findAll();

        return $this->render('houses/index.html.twig', [
            'controller_name' => 'HousesController',
            'houses' => $houses,
        ]);
    }
}
