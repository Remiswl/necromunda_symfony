<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

	/**
	* @Route("/resources", name="resources")
	*/
    public function resources(): Response
    {
        return $this->render('home/resources.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
