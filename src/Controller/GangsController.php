<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\GangsRepository;
use App\Repository\MyGangersRepository;
use App\Form\MyGangersType;
// use Doctrine\Persistence\ObjectManager;

class GangsController extends AbstractController
{
    //private $em;

    //public function __contruct(ObjectManager $em)
    //{
    //    $this->em = $em;
    //}

    /**
     * @Route("/gangs", name="gangs")
     */
    public function list(GangsRepository $repository): Response
    {
        $gangs_names = $repository->displayGangsNames();

        return $this->render('gangs/gangs_names.html.twig', [
            'controller_name' => 'GangsController',
            'gangs' => $gangs_names
        ]);
    }

    /**
     * @Route("/gangs/{gang_id}/{ganger_id}/edit", name="edit_ganger")
     */
    public function edit(MyGangersRepository $myGangersRepository, $gang_id, $ganger_id, Request $request): Response
    {
        $gangerData = $myGangersRepository->displayGangerData($ganger_id);

        // Créer le formulaire - Récupérer les données du formulaire MyGangersType
        $form = $this->createForm(MyGangersType::class, $gangerData);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // Comment ça fonctionne ? Possibilité de simplifier ?

            $em->persist($gangerData);
            $em->flush();

            return $this->redirectToRoute('my_gang', ['id' => $gang_id]);
        }

        return $this->render('gangs/edit.html.twig', [
            'gangerData' => $gangerData,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/gangs/{id}", name="my_gang")
     */
    public function show(GangsRepository $repository, MyGangersRepository $myGangersRepository, $id): Response
    {
        $gangData = $repository->displayGangData($id);
        //dump($gangData);

        if(!$gangData) {
            throw $this->createNotFoundException('Error: this gang does not exist');
        }

        $gangersData = $myGangersRepository->findAll($id); #Pourquoi findAll et non displayGangersData($id) ?
        //$gangersData = $myGangersRepository->displayGangersData($id)
        //dd($gangersData);

        return $this->render('gangs/my_gang.html.twig', [
            'controller_name' => 'GangsController',
            'gangData' => $gangData,
            'gangersData' => $gangersData
        ]);
    }





    /**
     * @Route("/new_gang", name="new_gang")
     * Prend en paramètres le pseudo le nom du gang et le House_id
     * Permet  1/ de créer les données générales du gang
     *         2/ de sélectionner les gangers à intégrer dans le gang (une autre méthode/classe ?)
     */
    /*
    public function newGang(EntityManagerInterface $entityManager): Response
    {
        $newGang = new Gangs();
        $newGang->setUserId(2)
            ->setGangTypeId(2)
            ->setCredits(50)
            ->setGangRating(10)
            ->setReputation(10)
            ->setWealth(10)
            ->setAlliance('none')
            ->setCreatedAt(new \DateTime('NOW'));

        $entityManager->persist($newGang); #Se préparer à envoyer la variable à Doctrine
        $entityManager->flush(); #Envoyer la variable à doctrine

        return $this->redirectToRoute('home');
    }
    */

    /* OU
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

    // public function edit()
    //
    // public function delete()
}