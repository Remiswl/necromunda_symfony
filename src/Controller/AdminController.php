<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\TerritoriesRepository;
use App\Repository\InjuriesRepository;
use App\Repository\WeaponsRepository;
use App\Repository\SkillsRepository;
use App\Entity\Territories;
use App\Entity\Skills;
use App\Entity\Weapons;
use App\Entity\Injuries;
use App\Form\TerritoriesType;
use App\Form\InjuriesType;
use App\Form\SkillsType;
use App\Form\WeaponsType;


class AdminController extends AbstractController
{
    private $injuriesRepository;
    private $territoriesRepository;
    private $weaponsRepository;
    private $skillsRepository;

    public function __construct(
        TerritoriesRepository $territoriesRepository,
        InjuriesRepository $injuriesRepository,
        SkillsRepository $skillsRepository,
        WeaponsRepository $weaponsRepository
    ){

    	$this->injuriesRepository = $injuriesRepository;
        $this->territoriesRepository = $territoriesRepository;
        $this->skillsRepository = $skillsRepository;
        $this->weaponsRepository = $weaponsRepository;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $territories = $this->territoriesRepository->findAll();
        $injuries = $this->injuriesRepository->findAll();
        $weapons = $this->weaponsRepository->findAll();
        $skills = $this->skillsRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'territories' => $territories,
            'injuries' => $injuries,
            'weapons' => $weapons,
            'skills' => $skills,
        ]);
    }

// Territories

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

// Injuries

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
    public function editInjuries(Request $request, $injury_id): Response
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

// Weapons

    /**
     * @Route("/admin/weapons/new_weapon", name="new_weapon")
     */
    public function newWeapon(Request $request): Response
    {
        $newWeapon = new Weapons();

        $form = $this->createForm(WeaponsType::class, $newWeapon);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($newWeapon);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/newWeapon.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/weapons/{weapon_id}/edit", name="edit_weapon")
     */
    public function editWeapon(Request $request, WeaponsRepository $weaponsRepository, $weapon_id): Response
    {
        $weaponData = $weaponsRepository->find($weapon_id);

        $form = $this->createForm(WeaponsType::class, $weaponData);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($weaponData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/editWeapons.html.twig', [
            'weapons' => $weaponData,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/weapons/{weapon_id}/delete", name="delete_weapon")
     */
    public function deleteWeapon($weapon_id): Response
    {
        $weapon = $this->getDoctrine()->getRepository(Weapons::class)->find($weapon_id);
        $weaponId = $weapon->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($weapon);
        $em->flush();

        return $this->redirectToRoute('admin');
    }

// Skills

    /**
     * @Route("/admin/skills/new_skill", name="new_skill")
     */
    public function newSkill(Request $request): Response
    {
        $newSkill = new Skills();

        $form = $this->createForm(SkillsType::class, $newSkill);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($newSkill);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/newSkill.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/skills/{skill_id}/edit", name="edit_skill")
     */
    public function editSkill(Request $request, SkillsRepository $skillsRepository, $skill_id): Response
    {
        $skillData = $skillsRepository->find($skill_id);

        $form = $this->createForm(SkillsType::class, $skillData);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skillData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/editSkills.html.twig', [
            'skills' => $skillData,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/skills/{skill_id}/delete", name="delete_skill")
     */
    public function deleteSkill($skill_id): Response
    {
        $skill = $this->getDoctrine()->getRepository(Skills::class)->find($skill_id);
        $tskillId = $skill->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($skill);
        $em->flush();

        return $this->redirectToRoute('admin');
    }
}
