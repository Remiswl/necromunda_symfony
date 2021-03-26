<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\GangTypeRepository;

class GangsController extends AbstractController
{
    /**
     * @Route("/gangs", name="gangs")
     */
    public function index(GangTypeRepository $repository): Response #Injecter la classe GangsRepository, sous le nom de $repository
    {
        $gangs = $repository->findAllGangsNames(); #Va récupérer la méthose findAllGangsNames de la classe $repository (src/Repository/GangTypeRepository.php)

        return $this->render('gangs/index.html.twig', [
            'controller_name' => 'GangsController', #ligne utile ?
            'gangs' => $gangs
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