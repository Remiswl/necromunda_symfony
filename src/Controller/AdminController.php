<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\HousesRepository;
use App\Repository\TerritoriesRepository;


class AdminController extends AbstractController
{
    private $housesRepository;
    private $territoriesRepository;

    public function __construct(HousesRepository $housesRepository, TerritoriesRepository $territoriesRepository){
    	$this->housesRepository=$housesRepository;
        $this->territoriesRepository=$territoriesRepository;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $houses = $this->housesRepository->findAll();
        $territories = $this->territoriesRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'houses' => $houses,
            'territories' => $territories
        ]);
    }

    /**
     * @Route("/new_territory", name="new_territory")
     */
    public function newTerritory(): Response
    {
        dd('ok');
    }
}
