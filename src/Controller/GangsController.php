<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\GangsRepository;

class GangsController extends AbstractController
{
    /**
     * @Route("/gangs/{id}", name="gangs")
     */
    public function index(GangsRepository $repository, $id): Response
    {
        $gangData = $repository->displayGangData($id);

        return $this->render('gangs/index.html.twig', [
            'controller_name' => 'GangsController',
            'gangData' => $gangData
        ]);
    }
}