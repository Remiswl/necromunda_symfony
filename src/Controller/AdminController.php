<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\TerritoriesRepository;
use App\Repository\InjuriesRepository;
use App\Entity\Territories;
use App\Entity\Injuries;
use App\Form\TerritoriesType;
use App\Form\InjuriesType;


class AdminController extends AbstractController
{
    private $injuriesRepository;
    private $territoriesRepository;

    public function __construct(TerritoriesRepository $territoriesRepository, InjuriesRepository $injuriesRepository){
    	$this->injuriesRepository=$injuriesRepository;
        $this->territoriesRepository=$territoriesRepository;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $territories = $this->territoriesRepository->findAll();
        $injuries = $this->injuriesRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'territories' => $territories,
            'injuries' => $injuries,
        ]);
    }

    /**
     * @Route("/admin/territories/new_territory", name="new_territory")
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
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/territories/{territory_id}/edit", name="edit_territory")
     */
    public function editTerritories(Request $request, TerritoriesRepository $territoriesRepository, $territory_id): Response
    {
        $territoryData = $territoriesRepository->find($territory_id);

        $form = $this->createForm(TerritoriesType::class, $territoryData);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($territoryData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/editTerritories.html.twig', [
            'territories' => $territoryData,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/territories/{territory_id}/delete", name="delete_territory")
     */
    public function deleteTerritories($territory_id): Response
    {
        $territory = $this->getDoctrine()->getRepository(Territories::class)->find($territory_id);
        $territoryId = $territory->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($territory);
        $em->flush();

        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin/injuries/new_injury", name="new_injury")
     */
    public function newInjury(Request $request): Response
    {
        $newInjury = new Injuries();

        $form = $this->createForm(InjuriesType::class, $newInjury);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newInjury);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/newInjury.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/injuries/{injury_id}/edit", name="edit_injury")
     */
    public function editInjuries(Request $request, InjuriesRepository $injuriesRepository, $injury_id): Response
    {
        $injuryData = $injuriesRepository->find($injury_id);

        $form = $this->createForm(InjuriesType::class, $injuryData);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($injuryData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/editInjuries.html.twig', [
            'injuries' => $injuryData,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/injuries/{injury_id}/delete", name="delete_injury")
     */
    public function deleteInjuries($injury_id): Response
    {
        $injury = $this->getDoctrine()->getRepository(Injuries::class)->find($injury_id);
        $injuryId = $injury->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($injury);
        $em->flush();

        return $this->redirectToRoute('admin');
    }
}
