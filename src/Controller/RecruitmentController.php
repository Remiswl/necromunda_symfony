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
                ->setReputation(4)
                ->setWealth(10)
                ->setAlliance('no')
                ->setCredits(1000)
                ->setGangRating(10)
                ->setCreatedAt(new \DateTime('NOW'));


            $em = $this->getDoctrine()->getManager();
            $em->persist($newGang);
            $em->flush();

            $id = $newGang->getId();

            return $this->redirectToRoute('my_gang', ['gang_id' => $id]);
        }

        return $this->render('recruitment/newGang.html.twig', [
            'form' => $form->createView()
        ]);
    }
}