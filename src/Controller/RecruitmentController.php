<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
// use App\Entity\Houses;

class RecruitmentController extends AbstractController
{
    public const GANGER_TYPE = [
        0 => 'Gang Leader',
        1 => 'Balaise',
        2 => 'Ganger',
        3 => 'Kid'
    ];


     /**
     * @Route("/newGang", name="new_gang")
     */
    public function newGang(): Response
    {
    	$form = $this -> createFormBuilder()
					-> add('pseudo') # ajouter texte dans la case
					-> add('gang_name')
					-> add('house_id') # Menu déroulant
					-> add('save', SubmitType::class, [
						'label' => 'Ready to fight'
					])
					-> getForm();

		return $this->render('recruitment/index.html.twig', [
            'controller_name' => 'RecruitmentController',
            'form' => $form -> createView()
        ]);
    }

    /**
     * @Route("/recruitment", name="recruitment")
     */
}


