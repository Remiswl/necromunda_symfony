<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\GangTypeRepository;


class AdminController extends AbstractController
{
    private $repository;

    public function __construct(GangTypeRepository $repository){
    	$this->repository=$repository->findAllGangsNames();
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $houses = repository;

        return $this->render('houses/index.html.twig', [
            'controller_name' => 'AdminController',
            'houses' => $houses
        ]);
    }
}
