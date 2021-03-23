<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

    /**
     * @Route("/recruitment", name="recruitment")
     */
    public function starter(): Response
    {
    	$form = $this 	-> createFormBuilder()
    					-> add('pseudo')
    					-> add('gang_name')
    					-> add('gang_type_id')
    					-> add('save', SubmitType::class, [
    						'label' => 'Ready to fight'
    					])
    					-> getForm();

		return $this->render('home/recruitment.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form -> createView()
        ]);

    }


}
