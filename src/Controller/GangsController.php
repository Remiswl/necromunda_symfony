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
use App\Repository\MyGangersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GangsController extends AbstractController
{
    /**
     * @Route("/gangs", name="gangs")
     */
    public function listGangs(GangsRepository $gangsRepository): Response
    {
        $gangsNames = $gangsRepository->findAll();

        return $this->render('gangs/gangs.html.twig', [
            'gangs' => $gangsNames,
        ]);
    }

    /**
     * @Route("/gangs/{gang_id}/show_gang", name="show_gang")
     */
    public function showGang(TerritoriesRepository $territoriesRepository, GangsRepository $gangsRepository, MyGangersRepository $myGangersRepository, $gang_id): Response
    {
        $gangData = $gangsRepository->displayGangData($gang_id);

        if (!$gangData) {
            throw $this->createNotFoundException('Error: this gang does not exist');
        }

        $gangersData = $myGangersRepository->displayGangersData($gang_id);
        $gangTerritories = $territoriesRepository->displayGangTerritories($gang_id);

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
    public function deleteGang($gang_id, GangsRepository $gangsRepository, MyGangersRepository $myGangersRepository): Response
    {
        // Select the gang to delete
        $myGang = $gangsRepository->find($gang_id);
        $gangId = $myGang->getId();

        // Also delete its gangers
        $gangersToDelete = $myGangersRepository->findAll();

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
     public function addTerritory(TerritoriesRepository $territoriesRepository, $gang_id): Response
    {
        $territories = $territoriesRepository->findAll();

        return $this->render('gangs/newTerritory.html.twig', [
            'territories' => $territories,
            'gang_id' => $gang_id,
        ]);
    }

    /**
     * @Route("/gangs/{gang_id}/insert_new_territory/{territory_id}", name="insert_new_territory_in_db")
     */
    public function insertTerritory(GangsRepository $gangsRepository, TerritoriesRepository $territoriesRepository, $gang_id, $territory_id): Response
    {
        $newTerritory = $territoriesRepository->find($territory_id);

        $myGang = $gangsRepository->find($gang_id);
        $myGang->addTerritory($newTerritory);

        $em = $this->getDoctrine()->getManager();
        $em->persist($myGang);
        $em->flush();

        $this->addFlash('success', 'Territory added!');

        return $this->redirectToRoute('show_gang', [
            'gang_id' => $gang_id,
        ]);
    }


// Injuries

    /**
     * @Route("/gangers/{ganger_id}/new_injury", name="new_ganger_injury")
     *
     */
     public function addInjury(InjuriesRepository $injuriesRepository, $ganger_id): Response
    {
        dd('ok');
    }

// Weapons

    /**
     * @Route("/gangers/{ganger_id}/new_weapon", name="new_ganger_weapon")
     *
     */
     public function addWeapon(WeaponsRepository $weaponsRepository, $ganger_id): Response
    {
        dd('ok');
    }

// Skills

    /**
     * @Route("/gangers/{ganger_id}/new_skill", name="new_ganger_skill")
     *
     */
     public function addSkill(SkillsRepository $skillsRepository, $gang_id): Response
    {
        dd('ok');
    }


// Gangers

    /**
     * @Route("/gangs/{gang_id}/add_ganger", name="new_ganger")
     */
    public function addGanger(GangsRepository $gangsRepository, GangersTypesRepository $gangersTypesRepository, GangersImgRepository $gangersImgRepository, Request $request, $gang_id): Response
    {
        $newGanger = new MyGangers();

        $houseId = $gangsRepository->find($gang_id);
        $houseId = $houseId->getHouse()->getId();
        $gangerImg = $gangersImgRepository->findImg($houseId);

        $form = $this->createForm(NewGangerType::class, $newGanger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gangerTypeId = $newGanger->getGangerType()->getId();
            $gangerTypeId = $gangersTypesRepository->find($gangerTypeId);

            $gangData = $gangsRepository->find(intval($gang_id));

            $gangId = $gangData->getId();
            $gangId = $gangsRepository->find($gangId);

            $newGanger
                ->setGang($gangId)
                ->setGangerType($gangerTypeId)
                ->setMove(4)
                ->setAdv(0)
                ->setXp(0)
                ->setCredits(0)
                ->setCreatedAt(new \DateTime('NOW'));

            if (1 === $gangerTypeId->getId()) {
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
                    ->setImage('img/cawdor_figurine.png');
            } elseif (2 === $gangerTypeId->getId()) {
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
                    ->setImage('img/cawdor_figurine.png');
            } elseif (3 === $gangerTypeId->getId()) {
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
                    ->setImage('img/cawdor_figurine.png');
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($newGanger);
            $em->flush();

            $this->addFlash('success', 'New ganger hired!');

            return $this->redirectToRoute('show_gang', ['gang_id' => $gang_id]);
        }

        return $this->render('gangs/newGanger.html.twig', [
            'form' => $form->createView(),
            'houseId' => $houseId,
            'images' => $gangerImg,
            'gangId' => $gang_id,
        ]);
    }

    /**
     * @Route("/gangers/{ganger_id}/edit", name="edit_ganger")
     */
    public function editGangers(MyGangersRepository $myGangersRepository, GangersTypesRepository $gangersTypesRepository, $ganger_id, Request $request): Response
    {
        $gangerData = $myGangersRepository->find($ganger_id);

        $gangerType = $gangersTypesRepository->find($ganger_id);
        $gangerType = $gangerData->getGangerType()->__toString();

        $gangId = $gangerData->getGang()->getId();

        $form = $this->createForm(MyGangersType::class, $gangerData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gangerData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('show_gang', ['gang_id' => $gangId]);
        }

        return $this->render('gangs/edit.html.twig', [
            'gangerData' => $gangerData,
            'form' => $form->createView(),
            'gang_id' => $gangId,
        ]);
    }

    /**
     * @Route("/gangers/{ganger_id}/delete", name="delete_ganger", methods="DELETE")
     */
    public function deleteGanger($ganger_id): Response
    {
        $myGangers = $this->getDoctrine()->getRepository(MyGangers::class)->find($gangerid);
        $gangId = $myGangers->getGang()->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($myGangers);
        $em->flush();

        return $this->redirectToRoute('show_gang', ['gang_id' => $gangId]);
    }
}
