<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResourcesController extends AbstractController
{
    /**
     * @Route("/resources", name="resources")
     */
    public function displayResources(): Response
    {
        return $this->render('resources/index.html.twig', [
            'controller_name' => 'ResourcesController',
        ]);
    }
}
