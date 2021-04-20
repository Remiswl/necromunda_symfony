<?php

namespace App\Controller;

use App\Entity\Gangs;
use App\Form\NewGangType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecruitmentController extends AbstractController
{
    /**
     * @Route("/newGang", name="new_gang")
     */
    public function newGang(Request $request): Response
    {
        $newGang = new Gangs();

        $form = $this->createForm(NewGangType::class, $newGang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newGang
                ->setCredits(1000)
                ->setGangRating(0)
                ->setCreatedAt(new \DateTime('NOW'));

            if (1 === $newGang->getHouse()->getId()) {
                $newGang->setImage('img/cawdor.jpg');
            } elseif (2 === $newGang->getHouse()->getId()) {
                $newGang->setImage('img/Delaque/delaque_arms.png');
            } elseif (3 === $newGang->getHouse()->getId()) {
                $newGang->setImage('img/Escher/escher_arms.png');
            } elseif (4 === $newGang->getHouse()->getId()) {
                $newGang->setImage('img/Goliath/goliath_arms.png');
            } elseif (5 === $newGang->getHouse()->getId()) {
                $newGang->setImage('img/cawdor.jpg');
            } elseif (6 === $newGang->getHouse()->getId()) {
                $newGang->setImage('img/Van_Saar/van_saar_arms.png');
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($newGang);
            $em->flush();

            $id = $newGang->getId();

            return $this->redirectToRoute('show_gang', ['gang_id' => $id]);
        }

        return $this->render('recruitment/newGang.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
