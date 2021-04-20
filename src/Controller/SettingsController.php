<?php

namespace App\Controller;

use App\Entity\Injuries;
use App\Entity\Skills;
use App\Entity\Territories;
use App\Entity\Weapons;
use App\Form\InjuriesType;
use App\Form\SkillsType;
use App\Form\TerritoriesType;
use App\Form\WeaponsType;
use App\Repository\InjuriesRepository;
use App\Repository\SkillsRepository;
use App\Repository\TerritoriesRepository;
use App\Repository\WeaponsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class SettingsController extends AbstractController
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
    ) {
        $this->injuriesRepository = $injuriesRepository;
        $this->territoriesRepository = $territoriesRepository;
        $this->skillsRepository = $skillsRepository;
        $this->weaponsRepository = $weaponsRepository;
    }

    /**
     * @Route("/settings", name="settings")
     */
    public function index(): Response
    {
        $territories = $this->territoriesRepository->findAll();
        $injuries = $this->injuriesRepository->findAll();
        $weapons = $this->weaponsRepository->findAll();
        $skills = $this->skillsRepository->findAll();

        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
            'territories' => $territories,
            'injuries' => $injuries,
            'weapons' => $weapons,
            'skills' => $skills,
        ]);
    }

    // Territories

    /**
     * @Route("/settings/territories/new_territory", name="new_territory")
     */
    public function newTerritory(Request $request): Response
    {
        $newTerritory = new Territories();

        $form = $this->createForm(TerritoriesType::class, $newTerritory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newTerritory);
            $em->flush();

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/newTerritory.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/territories/{territory_id}/edit", name="edit_territory")
     */
    public function editTerritories(Request $request, TerritoriesRepository $territoriesRepository, $territory_id): Response
    {
        $territoryData = $territoriesRepository->find($territory_id);

        $form = $this->createForm(TerritoriesType::class, $territoryData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($territoryData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/editTerritory.html.twig', [
            'territories' => $territoryData,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/territories/{territory_id}/delete", name="delete_territory")
     */
    public function deleteTerritories($territory_id): Response
    {
        $territory = $this->getDoctrine()->getRepository(Territories::class)->find($territory_id);
        $territoryId = $territory->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($territory);
        $em->flush();

        return $this->redirectToRoute('settings');
    }

    // Injuries

    /**
     * @Route("/settings/injuries/new_injury", name="new_injury")
     */
    public function newInjury(Request $request): Response
    {
        $newInjury = new Injuries();

        $form = $this->createForm(InjuriesType::class, $newInjury);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newInjury);
            $em->flush();

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/newInjury.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/injuries/{injury_id}/edit", name="edit_injury")
     */
    public function editInjuries(Request $request, InjuriesRepository $injuriesRepository, $injury_id): Response
    {
        $injuryData = $injuriesRepository->find($injury_id);

        $form = $this->createForm(InjuriesType::class, $injuryData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($injuryData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/editInjury.html.twig', [
            'injuries' => $injuryData,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/injuries/{injury_id}/delete", name="delete_injury")
     */
    public function deleteInjuries($injury_id): Response
    {
        $injury = $this->getDoctrine()->getRepository(Injuries::class)->find($injury_id);
        $injuryId = $injury->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($injury);
        $em->flush();

        return $this->redirectToRoute('settings');
    }

    // Weapons

    /**
     * @Route("/settings/weapons/new_weapon", name="new_weapon")
     */
    public function newWeapon(Request $request): Response
    {
        $newWeapon = new Weapons();

        $form = $this->createForm(WeaponsType::class, $newWeapon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newWeapon);
            $em->flush();

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/newWeapon.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/weapons/{weapon_id}/edit", name="edit_weapon")
     */
    public function editWeapon(Request $request, WeaponsRepository $weaponsRepository, $weapon_id): Response
    {
        $weaponData = $weaponsRepository->find($weapon_id);

        $form = $this->createForm(WeaponsType::class, $weaponData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($weaponData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/editWeapon.html.twig', [
            'weapons' => $weaponData,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/weapons/{weapon_id}/delete", name="delete_weapon")
     */
    public function deleteWeapon($weapon_id): Response
    {
        $weapon = $this->getDoctrine()->getRepository(Weapons::class)->find($weapon_id);
        $weaponId = $weapon->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($weapon);
        $em->flush();

        return $this->redirectToRoute('settings');
    }

    // Skills

    /**
     * @Route("/settings/skills/new_skill", name="new_skill")
     */
    public function newSkill(Request $request): Response
    {
        $newSkill = new Skills();

        $form = $this->createForm(SkillsType::class, $newSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newSkill);
            $em->flush();

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/newSkill.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/skills/{skill_id}/edit", name="edit_skill")
     */
    public function editSkill(Request $request, SkillsRepository $skillsRepository, $skill_id): Response
    {
        $skillData = $skillsRepository->find($skill_id);

        $form = $this->createForm(SkillsType::class, $skillData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skillData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/editSkill.html.twig', [
            'skills' => $skillData,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/skills/{skill_id}/delete", name="delete_skill")
     */
    public function deleteSkill($skill_id): Response
    {
        $skill = $this->getDoctrine()->getRepository(Skills::class)->find($skill_id);
        $tskillId = $skill->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($skill);
        $em->flush();

        return $this->redirectToRoute('settings');
    }
}
