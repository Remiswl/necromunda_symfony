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
        $territories = $this->territoriesRepository->findBy(array(), array('mind66' => 'ASC'));
        $injuries = $this->injuriesRepository->findBy(array(), array('minD66' => 'ASC'));
        $weapons = $this->weaponsRepository->findBy(array(), array('category' => 'ASC'));
        $skills = $this->skillsRepository->findBy(array(), array('category' => 'ASC'));

        return $this->render('settings/index.html.twig', [
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

        return $this->render('settings/new.html.twig', [
            'topic' => 'Territory',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/territories/{territory_id}/edit", name="edit_territory")
     */
    public function editTerritories(Request $request, $territory_id): Response
    {
        $territoryData = $this->territoriesRepository->find($territory_id);

        if(!$territoryData) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(TerritoriesType::class, $territoryData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($territoryData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/edit.html.twig', [
            'topic' => 'Territory',
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

        if(!$territory) {
            throw $this->createNotFoundException();
        }

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

        return $this->render('settings/new.html.twig', [
            'topic' => 'Injury',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/injuries/{injury_id}/edit", name="edit_injury")
     */
    public function editInjuries(Request $request, $injury_id): Response
    {
        $injuryData = $this->injuriesRepository->find($injury_id);

        if(!$injuryData) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(InjuriesType::class, $injuryData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($injuryData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/edit.html.twig', [
            'topic' => 'Injury',
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

        if(!$injury) {
            throw $this->createNotFoundException();
        }

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

            $newWeapon->setAvailability(0)
                ->setShortRange(0)
                ->setLongRange(0)
                ->setShortAccuracy(0)
                ->setLongAccuracy(0)
                ->setStrength(0)
                ->setArmourPiercing(0)
                ->setDamage(0)
                ->setAmmo(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($newWeapon);
            $em->flush();

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/new.html.twig', [
            'topic' => 'Weapon',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/weapons/{weapon_id}/edit", name="edit_weapon")
     */
    public function editWeapon(Request $request, $weapon_id): Response
    {
        $weaponData = $this->weaponsRepository->find($weapon_id);

        if(!$weaponData) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(WeaponsType::class, $weaponData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($weaponData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/edit.html.twig', [
            'topic' => 'Weapon',
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

        if(!$weapon) {
            throw $this->createNotFoundException();
        }

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

        return $this->render('settings/new.html.twig', [
            'topic' => 'Skill',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/skills/{skill_id}/edit", name="edit_skill")
     */
    public function editSkill(Request $request, $skill_id): Response
    {
        $skillData = $this->skillsRepository->find($skill_id);

        if(!$skillData) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(SkillsType::class, $skillData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skillData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/edit.html.twig', [
            'topic' => 'Skill',
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

        if(!$skill) {
            throw $this->createNotFoundException();
        }

        $tskillId = $skill->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($skill);
        $em->flush();

        return $this->redirectToRoute('settings');
    }
}
