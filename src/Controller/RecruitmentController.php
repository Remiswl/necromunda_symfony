<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\GangType;

class RecruitmentController extends AbstractController
{
     /**
     * @Route("/recruitment", name="recruitment")
     */

    public function index(): Response
    {
    	$form = $this -> createFormBuilder()
					-> add('pseudo') # ajouter texte dans la case
					-> add('gang_name')
					-> add('gang_type_id') # Menu déroulant
					-> add('save', SubmitType::class, [
						'label' => 'Ready to fight'
					])
					-> getForm();

		return $this->render('recruitment/index.html.twig', [
            'controller_name' => 'RecruitmentController',
            'form' => $form -> createView()
        ]);
    }

    /* Pour ajouter des valeurs dans une table -> fonctionne */
    /*
    public function index(): Response
    {
        $gangsNames = new GangType(); #Pour instancier la classe correspondant à la table Gangs (cf src/Entity/nom_de_la_classe_en_question)
        $gangsNames->setName('Delaque'); #un seul setName à la fois --> possibilité d'ajouter plusieurs noms ?
        $gangsName = $this->getDoctrine()->getManager();
        $gangsName->persist($gangsNames);
        $gangsName->flush();

        return $this->render('recruitment/index.html.twig', [
            'controller_name' => 'RecruitmentController',
        ]);
    }
    */
}


