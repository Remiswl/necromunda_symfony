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
    	$this->repository=$repository;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $houses = $this->repository->findAllGangsNames();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'houses' => $houses
        ]);
    }
}
