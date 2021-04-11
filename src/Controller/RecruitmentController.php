<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Gangs;
use App\Form\NewGangType;

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

        if($form->isSubmitted() && $form->isValid()) {

            $newGang
                ->setCredits(1000)
                ->setGangRating(0)
                ->setCreatedAt(new \DateTime('NOW'));

            if ($newGang->getHouse()->getId() === 1) {
                $newGang->setImage('img/cawdor.jpg');
            } else if ($newGang->getHouse()->getId() === 2) {
                $newGang->setImage('img/Delaque/delaque_arms.png');
            } else if ($newGang->getHouse()->getId() === 3) {
                $newGang->setImage('img/Escher/escher_arms.png');
            } else if ($newGang->getHouse()->getId() === 4) {
                $newGang->setImage('img/Goliath/goliath_arms.png');
            } else if ($newGang->getHouse()->getId() === 5) {
                $newGang->setImage('img/cawdor.jpg');
            } else if ($newGang->getHouse()->getId() === 6) {
                $newGang->setImage('img/Van_Saar/van_saar_arms.png');
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($newGang);
            $em->flush();

            $id = $newGang->getId();

            return $this->redirectToRoute('show_gang', ['gang_id' => $id]);
        }

        return $this->render('recruitment/newGang.html.twig', [
            'form' => $form->createView()
        ]);
    }
}