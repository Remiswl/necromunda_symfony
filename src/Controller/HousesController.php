<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\HousesRepository;

class HousesController extends AbstractController
{
    /**
     * @Route("/houses", name="houses")
     */
    public function index(HousesRepository $repository): Response #Injecter la classe GangsRepository, sous le nom de $repository
    {
        $houses = $repository->findAllGangsNames(); #Va récupérer la méthode findAllGangsNames de la classe $repository (src/Repository/GangTypeRepository.php)

        return $this->render('houses/index.html.twig', [
            'controller_name' => 'HousesController', #ligne utile ?
            'houses' => $houses #renvoyer le résultat de la requête
        ]);
    }

	/* OU
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(GangType::class); #Va récupérer les données dans src/Repository/nom_de_la_classe_en_question

        return $this->render('recruitment/index.html.twig', [
            'controller_name' => 'RecruitmentController',
            'Gangs' => $gangs
        ]);
    }
    */
}
