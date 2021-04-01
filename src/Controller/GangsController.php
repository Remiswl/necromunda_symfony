<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\GangsRepository;
use App\Repository\MyGangersRepository;
use App\Repository\GangersRepository;
use App\Repository\GangersTypesRepository;
use App\Form\MyGangersType;
use App\Entity\GangersTypes;
use App\Entity\MyGangers;
use App\Entity\Gangers;
use App\Entity\Gangs;
use App\Form\NewGangerType;


class GangsController extends AbstractController
{
    /**
     * @Route("/gangs", name="gangs")
     */
    public function listGangs(GangsRepository $repository): Response
    {
        $gangs_names = $repository->displayGangsNames();

        //$newGang = $this->getDoctrine()->getRepository(Gangs::class)->findAll();

        return $this->render('gangs/gangs.html.twig', [
            'controller_name' => 'GangsController',
            'gangs' => $gangs_names
        ]);
    }

    /**
     * @Route("/gangs/{gang_id}/edit", name="my_gang")
     */
    public function showGangers(GangsRepository $repository, MyGangersRepository $myGangersRepository, $gang_id, GangersTypesRepository $gangersTypesRepository): Response
    {
        $gangData = $repository->displayGangData($gang_id);

        if(!$gangData) {
            throw $this->createNotFoundException('Error: this gang does not exist');
        }

        $gangersData = $myGangersRepository->displayGangersData($gang_id);

        return $this->render('gangs/my_gang.html.twig', [
            'controller_name' => 'GangsController',
            'gangData' => $gangData,
            'gangersData' => $gangersData
        ]);
    }

    /**
     * @Route("/gangs/{gang_id}/delete", name="delete_gang", methods="DELETE")
     */
    public function deleteGang(MyGangersRepository $myGangersRepository, $gang_id, Request $request): Response
    {
        $myGang = $this->getDoctrine()->getRepository(Gangs::class)->find($gang_id);
        $gangId = $myGang->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($myGang);
        $em->flush();

        return $this->redirectToRoute('gangs');
    }

    /**
     * @Route("/gangs/{gang_id}/add", name="new_ganger")
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
                ->setCredits(0)
                ->setCool(0)
                ->setWillpower(0)
                ->setIntelligence(0);

            if($gangerTypeId->getId() === 1){
                $newGanger
                    ->setMove(4)
                    ->setWeaponSkill(4)
                    ->setBallisticSkill(4)
                    ->setStrength(3)
                    ->setToughness(3)
                    ->setWounds(1)
                    ->setInitiative(4)
                    ->setAttacks(1)
                    ->setLeadership(8)
                    ->setCost(120)
                    ->setAdv(0)
                    ->setXp(0)
                    ->setImage('img/cawdor_figurine.png');
            } else if($gangerTypeId->getId() === 2){
                $newGanger
                    ->setMove(4)
                    ->setWeaponSkill(3)
                    ->setBallisticSkill(3)
                    ->setStrength(3)
                    ->setToughness(3)
                    ->setWounds(1)
                    ->setInitiative(3)
                    ->setAttacks(1)
                    ->setLeadership(7)
                    ->setCost(60)
                    ->setAdv(0)
                    ->setXp(0)
                    ->setImage('img/cawdor_figurine.png');
            } else if($gangerTypeId->getId() === 3){
                $newGanger
                    ->setMove(4)
                    ->setWeaponSkill(3)
                    ->setBallisticSkill(3)
                    ->setStrength(3)
                    ->setToughness(3)
                    ->setWounds(1)
                    ->setInitiative(3)
                    ->setAttacks(1)
                    ->setLeadership(7)
                    ->setCost(50)
                    ->setAdv(0)
                    ->setXp(0)
                    ->setImage('img/cawdor_figurine.png');
            } else if($gangerTypeId->getId() === 4){
                $newGanger
                    ->setMove(4)
                    ->setWeaponSkill(2)
                    ->setBallisticSkill(2)
                    ->setStrength(3)
                    ->setToughness(3)
                    ->setWounds(1)
                    ->setInitiative(3)
                    ->setAttacks(1)
                    ->setLeadership(6)
                    ->setCost(25)
                    ->setAdv(0)
                    ->setXp(0)
                    ->setImage('img/cawdor_figurine.png');
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($newGanger);
            $em->flush();

            $this->addFlash('success', 'New ganger hired!');

            return $this->redirectToRoute('my_gang', ['gang_id' => $gang_id]);
        }

        return $this->render('gangs/new_ganger.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/gangs/gangers/{ganger_id}/edit", name="edit_ganger")
     */
    public function editGangers(MyGangersRepository $myGangersRepository, $ganger_id, Request $request): Response
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

            return $this->redirectToRoute('my_gang', ['gang_id' => $gangId]);
        }

        return $this->render('gangs/edit.html.twig', [
            'gangerData' => $gangerData,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/gangs/gangers/{ganger_id}/delete", name="delete_ganger", methods="DELETE")
     */
    public function deleteGanger(MyGangersRepository $myGangersRepository, $ganger_id, Request $request): Response
    {
        $myGangers = $this->getDoctrine()->getRepository(MyGangers::class)->find($ganger_id);
        $gangId = $myGangers->getGang()->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($myGangers);
        $em->flush();

        return $this->redirectToRoute('my_gang', ['gang_id' => $gangId]);
    }
}