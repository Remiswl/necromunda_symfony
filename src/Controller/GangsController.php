<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\GangsRepository;
use App\Repository\MyGangersRepository;
use App\Repository\GangersTypesRepository;
use App\Form\MyGangersType;
use App\Entity\GangersTypes;
use App\Entity\MyGangers;


class GangsController extends AbstractController
{
    /**
     * @Route("/gangs", name="gangs")
     */
    public function list(GangsRepository $repository): Response
    {
        $gangs_names = $repository->displayGangsNames();

        //$newGang = $this->getDoctrine()->getRepository(Gangs::class)->findAll();

        return $this->render('gangs/gangs_names.html.twig', [
            'controller_name' => 'GangsController',
            'gangs' => $gangs_names
        ]);
    }

    /**
     * @Route("/gangers/{ganger_id}/edit", name="edit_my_ganger")
     */
    public function edit(MyGangersRepository $myGangersRepository, $ganger_id, Request $request): Response
    {
        // Obtenir les données du ganger
        $gangerData = $this->getDoctrine()->getRepository(MyGangers::class)->find($ganger_id);

        // Obtenir le type de ganger
         $gangerType = $this->getDoctrine()->getRepository(GangersTypes::class)->find($ganger_id);
         $gangerType = $gangerData->getGangerType()->__toString();

        // Obtenir l'id du gang
        $gang_id = $gangerData->getGangId();

        // Créer le formulaire - Récupérer les données du formulaire MyGangersType
        $form = $this->createForm(MyGangersType::class, $gangerData);
        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gangerData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('my_gang', ['gang_id' => $gang_id]);
        }

        return $this->render('gangs/edit.html.twig', [
            'gangerData' => $gangerData,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/gangs/{gang_id}", name="my_gang")
     */
    public function show(GangsRepository $repository, MyGangersRepository $myGangersRepository, $gang_id, GangersTypesRepository $gangersTypesRepository): Response
    {
        // Récupérer les infos du gang
        $gangData = $repository->displayGangData($gang_id);

        if(!$gangData) {
            throw $this->createNotFoundException('Error: this gang does not exist');
        }
        // Récupérer les infos de chaque ganger du gang
        $gangersData = $myGangersRepository->displayGangersData($gang_id);

        return $this->render('gangs/my_gang.html.twig', [
            'controller_name' => 'GangsController',
            'gangData' => $gangData,
            'gangersData' => $gangersData
        ]);
    }

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

    /**
     * @Route("/new_ganger", name="new_ganger")
     * Insérer un nouveau ganger dans la BDD
     */
    /*
    public function newGanger(EntityManagerInterface $entityManager): Response
    {
        $newGanger = new MyGangers();
        $newGanger->setName('Chuck Norris')
            ->setTypeId(2)
            ->setGangId(3)
            ->setCredits(45)
            ->setMove(4)
            ->setWeaponSkill(4)
            ->setBallisticSkill(4)
            ->setStrength(4)
            ->setToughness(3)
            ->setWounds(3)
            ->setInitiative(1)
            ->setAttacks(4)
            ->setLeadership(1)
            ->setCool(8)
            ->setWillpower(2)
            ->setIntelligence(4)
            ->setCost(185)
            ->setAdv(4)
            ->setXp(64)
            ->setImage('img/cawdor_figurine.png');
        $entityManager->persist($newGanger);
        $entityManager->flush();
        return $this->redirectToRoute('home');
    }
    */
}