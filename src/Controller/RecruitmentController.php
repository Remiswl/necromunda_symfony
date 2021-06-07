<?php

namespace App\Controller;

use App\Entity\Gangs;
use App\Entity\GangTerritory;
use App\Form\NewGangType;
use App\Repository\TerritoriesRepository;
use App\Repository\GangTerritoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecruitmentController extends AbstractController
{
    /**
     * @Route("/newGang", name="new_gang")
     */
    public function newGang(Request $request, TerritoriesRepository $territoriesRepository, GangTerritoryRepository $gangTerritoryRepository): Response
    {
        $newGang = new Gangs();

        $form = $this->createForm(NewGangType::class, $newGang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newGang
                ->setCredits(1000)
                ->setGangRating(0)
                ->setCreatedAt(new \DateTime('NOW'));


            $houseId = $newGang->getHouse()->getId();

            if (1 === $houseId) {
                $newGang->setImage('img/cawdor.jpg');
            } elseif (2 === $houseId) {
                $newGang->setImage('img/arms/delaque_arms.png');
            } elseif (3 === $houseId) {
                $newGang->setImage('img/arms/escher_arms.png');
            } elseif (4 === $houseId) {
                $newGang->setImage('img/arms/goliath_arms.png');
            } elseif (5 === $houseId) {
                $newGang->setImage('img/cawdor.jpg');
            } elseif (6 === $houseId) {
                $newGang->setImage('img/arms/van_saar_arms.png');
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($newGang);
            $em->flush();

            $id = $newGang->getId();


            // Automatically add 5 random territories
            $territories = $territoriesRepository->findAll();

            for($i = 0; $i < 5; $i++) {
                $territoryScore = rand(1,sizeof($territories) - 1);
                $newTerritory = $territories[$territoryScore];

                $count = $gangTerritoryRepository->findOneBy(array(
                    'gang' => $id,
                    'territory' => $newTerritory->getId(),
                ));

                if($count === NULL) {
                    $count = new GangTerritory();
                    $count
                        ->setGang($newGang)
                        ->setTerritory($newTerritory)
                        ->setCount(1);
                } else {
                    $count->setCount($count->getCount() + 1);
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($count);
                $em->flush();

                // Add the territory in territories_gangs
                $newGangTerritory = $territoriesRepository->find($newTerritory->getId());
                $newGang->addTerritory($newGangTerritory);
            }

            $em->persist($newGang);
            $em->flush();

            return $this->redirectToRoute('show_gang', ['gang_id' => $id]);
        }

        return $this->render('recruitment/newGang.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
