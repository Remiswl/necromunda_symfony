<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\GangsRepository;
use App\Repository\MyGangersRepository;

class GangsController extends AbstractController
{
    /**
     * @Route("/gangs/{id}", name="gangs")
     */
    public function show(GangsRepository $repository, MyGangersRepository $gangersRepository, $id): Response
    {
        $gangData = $repository->displayGangData($id);
        // dd($gangData);

        if(!$gangData) {
            throw $this->createNotFoundException('Error: this gang does not exist');
        }

        $gangersData = $gangersRepository->findAll($id); #Pourquoi findAll et non displayGangersData($id) ?
        //$gangersData = $gangersRepository->displayGangersData($id)
        // dd($gangersData);

        return $this->render('gangs/index.html.twig', [
            'controller_name' => 'GangsController',
            'gangData' => $gangData,
            'gangersData' => $gangersData
        ]);
    }


    // public function edit()
    //
    // public function delete()
}