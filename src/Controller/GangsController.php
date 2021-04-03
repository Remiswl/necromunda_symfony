<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\GangsRepository;
use App\Repository\MyGangersRepository;
use App\Form\MyGangersType;
use App\Form\NewGangerType;
use App\Entity\GangersTypes;
use App\Entity\MyGangers;
use App\Entity\Gangers;
use App\Entity\Gangs;

class GangsController extends AbstractController
{
    /**
     * @Route("/gangs", name="gangs")
     */
    public function listGangs(GangsRepository $gangsRepository): Response
    {
        $gangs_names = $gangsRepository->displayGangsNames();

        return $this->render('gangs/gangs.html.twig', [
            'controller_name' => 'GangsController',
            'gangs' => $gangs_names
        ]);
    }

    /**
     * @Route("/gangs/{gang_id}/show_gang", name="show_gang")
     */
    public function showGang(GangsRepository $gangsRepository, MyGangersRepository $myGangersRepository, $gang_id): Response
    {
        $gangData = $gangsRepository->displayGangData($gang_id);

        if(!$gangData) {
            throw $this->createNotFoundException('Error: this gang does not exist');
        }

        $gangersData = $myGangersRepository->displayGangersData($gang_id);

        $totalCost = 0;
        $totalExp = 0;
        for($i = 0; $i < sizeof($gangersData); $i++) {
            $totalCost += $gangersData[$i]->getCost();
            $totalExp += $gangersData[$i]->getXp();
        }

        return $this->render('gangs/myGang.html.twig', [
            'controller_name' => 'GangsController',
            'gangData' => $gangData,
            'gangersData' => $gangersData,
            'totalCost' => $totalCost,
            'totalExp' => $totalExp
        ]);
    }

    /**
     * @Route("/gangs/{gang_id}/delete_gang", name="delete_gang", methods="DELETE")
     */
    public function deleteGang($gang_id): Response
    {
        // Select the gang to delete
        $myGang = $this->getDoctrine()->getRepository(Gangs::class)->find($gang_id);
        $gangId = $myGang->getId();

        // Also delete its gangers
        $gangersToDelete = $this->getDoctrine()->getRepository(MyGangers::class)->findAll();

        for ($i = 0; $i < sizeof($gangersToDelete); $i++) {
            if($gangersToDelete[$i]->getGang()->getId() === $gangId) {
                $this->deleteGanger($gangersToDelete[$i]->getId());
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($myGang);
        $em->flush();

        return $this->redirectToRoute('gangs');
    }

    /**
     * @Route("/gangs/{gang_id}/add_ganger", name="new_ganger")
     */
    public function addGanger(GangsRepository $gangsRepository, Request $request, $gang_id): Response
    {
        $gang_id = intval($gang_id);

        $newGanger = new MyGangers;

        $form = $this->createForm(NewGangerType::class, $newGanger);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $gangerTypeId = $newGanger->getGangerType()->getId();
            $gangerTypeId = $this->getDoctrine()->getRepository(GangersTypes::class)->find($gangerTypeId);

            $gangData = $gangsRepository->displayGangData($gang_id);

            $gangId = $gangData[0]->getId();
            $gangId = $this->getDoctrine()->getRepository(Gangs::class)->find($gangId);

            $newGanger
                ->setGang($gangId)
                ->setGangerType($gangerTypeId)
                ->setMove(4)
                ->setAdv(0)
                ->setXp(0)
                ->setCredits(0)
                ->setCreatedAt(new \DateTime('NOW'));

            if($gangerTypeId->getId() === 1){
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
            } else if($gangerTypeId->getId() === 2){
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
            } else if($gangerTypeId->getId() === 3){
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
            } else if($gangerTypeId->getId() === 4){
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
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/gangers/{ganger_id}/edit", name="edit_ganger")
     */
    public function editGangers($ganger_id, Request $request): Response
    {
        $gangerData = $this->getDoctrine()->getRepository(MyGangers::class)->find($ganger_id);

        $gangerType = $this->getDoctrine()->getRepository(GangersTypes::class)->find($ganger_id);
        $gangerType = $gangerData->getGangerType()->__toString();

        $gangId = $gangerData->getGang()->getId();

        $form = $this->createForm(MyGangersType::class, $gangerData);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gangerData);
            $em->flush();

            $this->addFlash('success', 'Data saved!');

            return $this->redirectToRoute('show_gang', ['gang_id' => $gangId]);
        }

        return $this->render('gangs/edit.html.twig', [
            'gangerData' => $gangerData,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/gangers/{ganger_id}/delete", name="delete_ganger", methods="DELETE")
     */
    public function deleteGanger($ganger_id): Response
    {
        $myGangers = $this->getDoctrine()->getRepository(MyGangers::class)->find($ganger_id);
        $gangId = $myGangers->getGang()->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($myGangers);
        $em->flush();

        return $this->redirectToRoute('show_gang', ['gang_id' => $gangId]);
    }

    /**
     * @Route("/gangs/{gang_id}/territories/add", name="new_territory")
     */
    /*
    public function addTerritory(): Response
    {

    }
    */
}