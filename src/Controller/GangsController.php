<?php

namespace App\Controller;

use App\Entity\Gangers;
use App\Entity\Gangs;
use App\Entity\Territories;
use App\Entity\MyGangers;
use App\Form\MyGangersType;
use App\Form\NewGangerType;
use App\Form\TerritoriesType;
use App\Repository\GangersImgRepository;
use App\Repository\GangersTypesRepository;
use App\Repository\GangsRepository;
use App\Repository\TerritoriesRepository;
use App\Repository\InjuriesRepository;
use App\Repository\WeaponsRepository;
use App\Repository\SkillsRepository;
use App\Repository\MyGangersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GangsController extends AbstractController
{
    private $territoriesRepository;
    private $injuriesRepository;
    private $skillsRepository;
    private $weaponsRepository;
    private $myGangersRepositor;
    private $gangsRepository;

    public function __construct(
        TerritoriesRepository $territoriesRepository,
        InjuriesRepository $injuriesRepository,
        SkillsRepository $skillsRepository,
        WeaponsRepository $weaponsRepository,
        MyGangersRepository $myGangersRepository,
        GangsRepository $gangsRepository
    ) {
        $this->territoriesRepository = $territoriesRepository;
        $this->injuriesRepository = $injuriesRepository;
        $this->skillsRepository = $skillsRepository;
        $this->weaponsRepository = $weaponsRepository;
        $this->myGangersRepository = $myGangersRepository;
        $this->gangsRepository = $gangsRepository;
    }

    /**
     * @Route("/gangs", name="gangs")
     */
    public function listGangs(): Response
    {
        $gangsNames = $this->gangsRepository->findAll();

        return $this->render('gangs/gangs.html.twig', [
            'gangs' => $gangsNames,
        ]);
    }

    /**
     * @Route("/gangs/{gang_id}/show_gang", name="show_gang")
     */
    public function showGang($gang_id): Response
    {
        $gangData = $this->gangsRepository->displayGangData($gang_id);

        if (!$gangData) {
            throw $this->createNotFoundException('Error: this gang does not exist');
        }

        // Check if the gang has a leader
        $numberOfLeaders = $this->myGangersRepository->findBy(array(
            'gangerType' => 1,
            'gang' => $gang_id
        ));

        if(sizeof($numberOfLeaders) === 0){
            $this->addFlash('error', 'Your gang has no leader!');
        }

        // Check if the gang has more than three gangers
        $numberOfGangers = $this->myGangersRepository->findBy(array('gang' => $gang_id));

        if(sizeof($numberOfGangers) < 3) {
            $this->addFlash('error', 'Your gang has less than three gangers!');
        }

        $gangTerritories = $this->territoriesRepository->displayGangTerritories($gang_id);
        $gangersData = $this->myGangersRepository->displayGangersData($gang_id);

        $totalCost = 0;
        $totalExp = 0;

        for ($i = 0; $i < sizeof($gangersData); ++$i) {
            $totalCost += $gangersData[$i]->getCost();
            $totalExp += $gangersData[$i]->getXp();
        }

        $gangRating = $totalCost + $totalExp;

        return $this->render('gangs/myGang.html.twig', [
            'gang_data' => $gangData,
            'gangers_data' => $gangersData,
            'gang_territories' => $gangTerritories,
            'total_cost' => $totalCost,
            'total_exp' => $totalExp,
            'gang_rating' => $gangRating,
        ]);
    }

    /**
     * @Route("/gangs/{gang_id}/delete_gang", name="delete_gang", methods="DELETE")
     */
    public function deleteGang($gang_id): Response
    {
        // Select the gang to delete
        $myGang = $this->gangsRepository->find($gang_id);

        if(!$myGang) {
            throw $this->createNotFoundException();
        }

        $gangId = $myGang->getId();

        // Also delete its gangers
        $gangersToDelete = $this->myGangersRepository->findAll();

        for ($i = 0; $i < sizeof($gangersToDelete); ++$i) {
            if ($gangersToDelete[$i]->getGang()->getId() === $gangId) {
                $this->deleteGanger($gangersToDelete[$i]->getId());
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($myGang);
        $em->flush();

        return $this->redirectToRoute('gangs');
    }

// Territories

    /**
     * @Route("/gangs/{gang_id}/new_territory", name="new_gang_territory")
     *
     */
     public function addTerritory($gang_id): Response
    {
        $territories = $this->territoriesRepository->findAll();

        return $this->render('gangs/newTerritory.html.twig', [
            'territories' => $territories,
            'gang_id' => $gang_id,
        ]);
    }

    /**
     * @Route("/gangs/{gang_id}/insert_new_territory/{territory_id}", name="insert_new_territory_in_db")
     */
    public function insertTerritory($gang_id, $territory_id): Response
    {
        $newTerritory = $this->territoriesRepository->find($territory_id);
        $myGang = $this->gangsRepository->find($gang_id);

        if(!$newTerritory || !$myGang) {
            throw $this->createNotFoundException();
        }

        $myGang->addTerritory($newTerritory);

        $em = $this->getDoctrine()->getManager();
        $em->persist($myGang);
        $em->flush();

        $this->addFlash('success', 'Territory added!');

        return $this->redirectToRoute('show_gang', [
            'gang_id' => $gang_id,
        ]);
    }

    /**
     * @Route("/gangs/{gang_id}/remove_gang_territory/{territory_id}", name="remove_gang_territory")
     */
    public function deleteTerritory($gang_id, $territory_id): Response
    {
        $territory = $this->territoriesRepository->find($territory_id);
        $myGang = $this->gangsRepository->find($gang_id);

        if(!$myGang || !$territory) {
            throw $this->createNotFoundException();
        }

        $myGang->removeTerritory($territory);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $this->addFlash('success', 'Territory removed!');

        return $this->redirectToRoute('show_gang', [
            'gang_id' => $gang_id,
        ]);
    }

// Weapons

    /**
     * @Route("/gangers/{ganger_id}/new_weapon", name="new_ganger_weapon")
     *
     */
     public function addWeapon($ganger_id): Response
    {
        $weapons = $this->weaponsRepository->findAll();

        return $this->render('gangs/newWeapon.html.twig', [
            'weapons' => $weapons,
            'ganger_id' => $ganger_id,
        ]);
    }

    /**
     * @Route("/gangs/{ganger_id}/insert_new_weapon/{weapon_id}", name="insert_new_weapon_in_db")
     */
    public function insertWeapon($ganger_id, $weapon_id): Response
    {
        $newWeapon = $this->weaponsRepository->find($weapon_id);
        $myGanger = $this->myGangersRepository->find($ganger_id);

        if(!$myGanger || !$newWeapon) {
            throw $this->createNotFoundException();
        }

        $myGanger->addWeapon($newWeapon);

        $gangId = $myGanger->getGang()->getId();
        $myGangData = $this->gangsRepository->find($gangId);
        $newCredits = $myGangData->getCredits() - $newWeapon->getCost();
        $myGangData->setCredits($newCredits);

        $em = $this->getDoctrine()->getManager();
        $em->persist($myGanger);
        $em->persist($myGangData);
        $em->flush();

        $this->addFlash('success', 'Weapon added!');

        return $this->redirectToRoute('edit_ganger', [
            'ganger_id' => $ganger_id,
        ]);
    }

    /**
     * @Route("/gangs/{ganger_id}/remove_weapon/{weapon_id}", name="remove_ganger_weapon")
     */
    public function deleteGangerWeapon($ganger_id, $weapon_id): Response
    {
        $weapon = $this->weaponsRepository->find($weapon_id);
        $myGanger = $this->myGangersRepository->find($ganger_id);

        if(!$myGanger || !$weapon) {
            throw $this->createNotFoundException();
        }

        $myGanger->removeWeapon($weapon);

        $gangId = $myGanger->getGang()->getId();
        $myGangData = $this->gangsRepository->find($gangId);
        $newCredits = $myGangData->getCredits() + $weapon->getCost();
        $myGangData->setCredits($newCredits);

        $em = $this->getDoctrine()->getManager();
        $em->persist($myGangData);
        $em->flush();

        $this->addFlash('success', 'Weapon removed!');

        return $this->redirectToRoute('edit_ganger', [
            'ganger_id' => $ganger_id,
        ]);
    }

// Injuries

    /**
     * @Route("/gangers/{ganger_id}/new_injury", name="new_ganger_injury")
     *
     */
     public function addInjury($ganger_id): Response
    {
        $injuries = $this->injuriesRepository->findAll();

        return $this->render('gangs/newInjury.html.twig', [
            'injuries' => $injuries,
            'ganger_id' => $ganger_id,
        ]);
    }

    /**
     * @Route("/gangs/{ganger_id}/insert_new_injury/{injury_id}", name="insert_new_injury_in_db")
     */
    public function insertInjury($ganger_id, $injury_id): Response
    {
        $newInjury = $this->injuriesRepository->find($injury_id);
        $myGanger = $this->myGangersRepository->find($ganger_id);

        if(!$myGanger || !$newInjury) {
            throw $this->createNotFoundException();
        }

        $myGanger->addInjury($newInjury);

        $em = $this->getDoctrine()->getManager();
        $em->persist($myGanger);
        $em->flush();

        $this->addFlash('success', 'Injury removed!');

        return $this->redirectToRoute('edit_ganger', [
            'ganger_id' => $ganger_id,
        ]);
    }

    /**
     * @Route("/gangs/{ganger_id}/remove_injury/{injury_id}", name="remove_ganger_injury")
     */
    public function deleteGangerInjury($ganger_id, $injury_id): Response
    {
        $injury = $this->injuriesRepository->find($injury_id);
        $myGanger = $this->myGangersRepository->find($ganger_id);

        if(!$myGanger || !$injury) {
            throw $this->createNotFoundException();
        }

        $myGanger->removeInjury($injury);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $this->addFlash('success', 'Injury removed!');

        return $this->redirectToRoute('edit_ganger', [
            'ganger_id' => $ganger_id,
        ]);
    }

// Skills

    /**
     * @Route("/gangers/{ganger_id}/new_skill", name="new_ganger_skill")
     *
     */
     public function addSkill($ganger_id): Response
    {
        $skills = $this->skillsRepository->findAll();

        return $this->render('gangs/newSkill.html.twig', [
            'skills' => $skills,
            'ganger_id' => $ganger_id,
        ]);
    }

    /**
     * @Route("/gangs/{ganger_id}/insert_new_skill/{skill_id}", name="insert_new_skill_in_db")
     */
    public function insertSkill($ganger_id, $skill_id): Response
    {
        $newSkill = $this->skillsRepository->find($skill_id);
        $myGanger = $this->myGangersRepository->find($ganger_id);

        if(!$myGanger || !$newSkill) {
            throw $this->createNotFoundException();
        }

        $myGanger->addSkill($newSkill);

        $em = $this->getDoctrine()->getManager();
        $em->persist($myGanger);
        $em->flush();

        $this->addFlash('success', 'Skill added!');

        return $this->redirectToRoute('edit_ganger', [
            'ganger_id' => $ganger_id,
        ]);
    }

    /**
     * @Route("/gangs/{ganger_id}/remove_skill/{skill_id}", name="remove_ganger_skill")
     */
    public function deleteGangerSkill($ganger_id, $skill_id): Response
    {
        $skill = $this->skillsRepository->find($skill_id);
        $myGanger = $this->myGangersRepository->find($ganger_id);

        if(!$myGanger || !$skill) {
            throw $this->createNotFoundException();
        }

        $myGanger->removeSkill($skill);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $this->addFlash('success', 'Skill removed!');

        return $this->redirectToRoute('edit_ganger', [
            'ganger_id' => $ganger_id,
        ]);
    }

// Gangers

    /**
     * @Route("/gangs/{gang_id}/add_ganger", name="new_ganger")
     */
    public function addGanger(GangersTypesRepository $gangersTypesRepository, GangersImgRepository $gangersImgRepository, Request $request, $gang_id): Response
    {
        $newGanger = new MyGangers();

        $houseId = $this->gangsRepository->find($gang_id);
        $houseId = $houseId->getHouse()->getId();

        // Display all the House's images
        $gangersImg = $gangersImgRepository->findBy(array('houseId' => $houseId));

        if(!$houseId) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(NewGangerType::class, $newGanger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gangerTypeId = $newGanger->getGangerType()->getId();
            $gangerTypeId = $gangersTypesRepository->find($gangerTypeId);

            $gangData = $this->gangsRepository->find(intval($gang_id));

            $gangId = $gangData->getId();
            $gangId = $this->gangsRepository->find($gangId);

            // Check if the gang already has a leader (only one allowed)
            $isSoleLeader = $this->myGangersRepository->findBy(array(
                'gangerType' => $gangerTypeId->getId(),
                'gang' => $gangId
            ));

            if(($gangerTypeId->getId() == 1) && (sizeof($isSoleLeader) != 0)) {
                // throw $this->createNotFoundException('Error: there can be only one leader in your gang!');
                $this->addFlash('error', 'Error: there can be only one leader in your gang!');

                return $this->render('gangs/newGanger.html.twig', [
                    'form' => $form->createView(),
                    'houseId' => $houseId,
                    'images' => $gangersImg,
                    'gangId' => $gang_id,
                ]);
            }


            // Check if the gang already has less than 2 heavies
            $maxTwoHeavies = $this->myGangersRepository->findBy(array(
                'gangerType' => $gangerTypeId->getId(),
                'gang' => $gangId
            ));

            if(($gangerTypeId->getId() == 2) && (sizeof($maxTwoHeavies) >= 2)) {
                $this->addFlash('error', 'Error: there can be a maximum of two Heavies in your gang!');

                return $this->render('gangs/newGanger.html.twig', [
                    'form' => $form->createView(),
                    'houseId' => $houseId,
                    'images' => $gangersImg,
                    'gangId' => $gang_id,
                ]);
            }

            // Check if the gang already has less than the half of his gang composed of juves
            $numberOfJuves = $this->myGangersRepository->findBy(array(
                'gangerType' => $gangerTypeId->getId(),
                'gang' => $gangId
            ));
            $numberOfJuves = sizeof($numberOfJuves);

            $gangSize =sizeof($gangData->getMyGangers());

            if(($gangerTypeId->getId() == 4) && ($numberOfJuves >= ($gangSize/2))) {
                $this->addFlash('error', 'Error: you have too many Juves in your gang!');

                return $this->render('gangs/newGanger.html.twig', [
                    'form' => $form->createView(),
                    'houseId' => $houseId,
                    'images' => $gangersImg,
                    'gangId' => $gang_id,
                ]);
            }

            $newGanger
                ->setGang($gangId)
                ->setGangerType($gangerTypeId)
                ->setMove(4)
                ->setAdv(0)
                ->setCredits(0)
                ->setCreatedAt(new \DateTime('NOW'));

            if (1 === $gangerTypeId->getId()) {
                $startXp = 60 + rand(1,6);
                $newGanger
                    ->setWeaponSkill(4)
                    ->setBallisticSkill(4)
                    ->setStrength(3)
                    ->setToughness(3)
                    ->setWounds(1)
                    ->setInitiative(4)
                    ->setAttacks(1)
                    ->setLeadership(8)
                    ->setCost(120)
                    ->setXp($startXp)
                    ->setImage('img/cawdor_figurine.png');
            } elseif (2 === $gangerTypeId->getId()) {
                $startXp = 60 + rand(1,6);
                $newGanger
                    ->setWeaponSkill(3)
                    ->setBallisticSkill(3)
                    ->setStrength(3)
                    ->setToughness(3)
                    ->setWounds(1)
                    ->setInitiative(3)
                    ->setAttacks(1)
                    ->setLeadership(7)
                    ->setCost(60)
                    ->setXp($startXp)
                    ->setImage('img/cawdor_figurine.png');
            } elseif (3 === $gangerTypeId->getId()) {
                $startXp = 20 + rand(1,6);
                $newGanger
                    ->setWeaponSkill(3)
                    ->setBallisticSkill(3)
                    ->setStrength(3)
                    ->setToughness(3)
                    ->setWounds(1)
                    ->setInitiative(3)
                    ->setAttacks(1)
                    ->setLeadership(7)
                    ->setCost(50)
                    ->setXp($startXp)
                    ->setImage('img/cawdor_figurine.png');
            } elseif (4 === $gangerTypeId->getId()) {
                $newGanger
                    ->setWeaponSkill(2)
                    ->setBallisticSkill(2)
                    ->setStrength(3)
                    ->setToughness(3)
                    ->setWounds(1)
                    ->setInitiative(3)
                    ->setAttacks(1)
                    ->setLeadership(6)
                    ->setCost(25)
                    ->setXp(0)
                    ->setImage('img/cawdor_figurine.png');
            }

            $weapon = $this->weaponsRepository->find(array('id' => 2));
            $newGanger->addWeapon($weapon);

            $newGangCredits = $gangData->getCredits() - $newGanger->getCost();

            if($newGangCredits <= 0) {
                // throw $this->createNotFoundException('Error: you have not enough credits');
                $this->addFlash('error', 'Error: you have not enough credits!');
            }

            $gangData->setCredits($newGangCredits);

            $em = $this->getDoctrine()->getManager();
            $em->persist($newGanger);
            $em->persist($gangData);
            $em->flush();

            $this->addFlash('success', 'New ganger hired!');

            return $this->redirectToRoute('show_gang', ['gang_id' => $gang_id]);
        }

        return $this->render('gangs/newGanger.html.twig', [
            'form' => $form->createView(),
            'houseId' => $houseId,
            'images' => $gangersImg,
            'gangId' => $gang_id,
        ]);
    }

    /**
     * @Route("/gangers/{ganger_id}/edit", name="edit_ganger")
     */
    public function editGangers(GangersTypesRepository $gangersTypesRepository, $ganger_id, Request $request): Response
    {
        $gangerData = $this->myGangersRepository->find($ganger_id);

        if(!$gangerData) {
            throw $this->createNotFoundException();
        }

        $gangerType = $gangersTypesRepository->find($ganger_id);
        $gangerType = $gangerData->getGangerType()->__toString();

        $gangId = $gangerData->getGang()->getId();

        $gangerWeapons = $this->weaponsRepository->displayGangerWeapons($ganger_id);
        $gangerInjuries = $this->injuriesRepository->displayGangerInjuries($ganger_id);
        $gangerSkills = $this->skillsRepository->displayGangerSkills($ganger_id);

        $form = $this->createForm(MyGangersType::class, $gangerData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($gangerType === 'Juve' && $gangerData->getXp() >= 21) {
                $newGangerType = $gangersTypesRepository->find(array('id' => 3));
                $gangerData->setGangerType($newGangerType);

                $this->addFlash('success', 'One of your kids, ' . $gangerData->getName() . ', gained enough experience and became a fully-fledged ganger. You now can change his profil picture and buy new weapons.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($gangerData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('show_gang', ['gang_id' => $gangId]);
        }

        return $this->render('gangs/edit.html.twig', [
            'gangerData' => $gangerData,
            'gangerImg' => $gangerData->getImage(),
            'ganger_id' => $ganger_id,
            'injuries' => $gangerInjuries,
            'weapons' => $gangerWeapons,
            'skills' => $gangerSkills,
            'form' => $form->createView(),
            'gang_id' => $gangId,
        ]);
    }

    /**
     * @Route("/gangers/{ganger_id}/edit_image", name="edit_image")
     */
    public function editGangerImage(GangersImgRepository $gangersImgRepository, $ganger_id, Request $request): Response
    {
        $gangerData = $this->myGangersRepository->find($ganger_id);
        $gangId = $gangerData->getGang();
        $houseId = $gangId->getHouse()->getId();

        if(!$gangerData || !$gangId || !$houseId) {
            throw $this->createNotFoundException();
        }

        // Get all gangers' images
        $gangersImg = $gangersImgRepository->findBy(array('houseId' => $houseId));

        return $this->render('gangs/editImage.html.twig', [
            'ganger_id' => $ganger_id,
            'gangers_imgs' => $gangersImg,
            'gang_id' => $gangId,
            'house_id' => $houseId,
        ]);
    }

    /**
     * @Route("/gangs/{ganger_id}/insert_new_image", name="insert_new_image_in_db")
     */
    public function insertImage($ganger_id, GangersImgRepository $gangersImgRepository, Request $request): Response
    {
        $newGangerImgId = $request->request->get('id');
        $newGangerImg = $gangersImgRepository->find($newGangerImgId)->getPath();

        $myGanger = $this->getDoctrine()->getRepository(MyGangers::class)->find($ganger_id);
        $myGanger->setImage($newGangerImg);

        $em = $this->getDoctrine()->getManager();
        $em->persist($myGanger);
        $em->flush();

        $this->addFlash('success', 'Image saved!');

        return $this->redirectToRoute('edit_ganger', ['ganger_id' => $ganger_id]);
    }

    /**
     * @Route("/gangers/{ganger_id}/delete", name="delete_ganger", methods="DELETE")
     */
    public function deleteGanger($ganger_id): Response
    {
        $myGanger = $this->getDoctrine()->getRepository(MyGangers::class)->find($ganger_id);

        if(!$myGanger) {
            throw $this->createNotFoundException();
        }

        $gangId = $myGanger->getGang()->getId();
        // $gangData = $this->gangsRepository->find(intval($gangId));
        // $newGangCredits = $gangData->getCredits() + $myGanger->getCost();
        // $gangData->setCredits($newGangCredits);

        $em = $this->getDoctrine()->getManager();
        $em->remove($myGanger);
        // $em->persist($gangData);
        $em->flush();

        return $this->redirectToRoute('show_gang', ['gang_id' => $gangId]);
    }
}
