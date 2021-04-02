<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\HousesRepository;


class AdminController extends AbstractController
{
    private $repository;

    public function __construct(HousesRepository $housesRepository){
    	$this->repository=$housesRepository;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $houses = $this->repository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'houses' => $houses
        ]);
    }
}
