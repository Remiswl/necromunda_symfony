<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\HousesRepository;
use App\Repository\TerritoriesRepository;
use App\Entity\Territories;
use App\Form\TerritoriesType;


class AdminController extends AbstractController
{
    private $housesRepository;
    private $territoriesRepository;

    public function __construct(HousesRepository $housesRepository, TerritoriesRepository $territoriesRepository){
    	$this->housesRepository=$housesRepository;
        $this->territoriesRepository=$territoriesRepository;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $houses = $this->housesRepository->findAll();
        $territories = $this->territoriesRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'houses' => $houses,
            'territories' => $territories
        ]);
    }

    /**
     * @Route("/new_territory", name="new_territory")
     */
    public function newTerritory(Request $request): Response
    {
        $newTerritory = new Territories();

        $form = $this->createForm(TerritoriesType::class, $newTerritory);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($newTerritory);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/newTerritory.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit_territories", name="edit_territories")
     */
    public function editTerritories(Request $request): Response
    {
        $territoriesData = $this->getDoctrine()->getRepository(Territories::class)->findAll();

        for ($i = 0; $i < sizeof($territoriesData); $i++) {
            $form = $this->createForm(TerritoriesType::class, $territoriesData[$i]);
        }

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            dd('ok');
            $em = $this->getDoctrine()->getManager();
            $em->persist($territoriesData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/editTerritories.html.twig', [
            'territoriesData' => $territoriesData,
            'form' => $form->createView()
        ]);
    }
}
