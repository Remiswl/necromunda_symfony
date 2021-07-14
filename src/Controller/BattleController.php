<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GangsRepository;
use Symfony\Component\HttpFoundation\Request;


class BattleController extends AbstractController
{
    private $gangsRepository;

    public function __construct(
        GangsRepository $gangsRepository
    ) {
        $this->gangsRepository = $gangsRepository;
    }

    /**
     * @Route("/battle1", name="battle1")
     */
    public function battle1(): Response
    {
        $gangsNames = $this->gangsRepository->findAll();

        return $this->render('battle/battle1.html.twig', [
            'gangs' => $gangsNames,
        ]);
    }

    /**
     * @Route("/battle2", name="battle2")
     */
    public function battle2(Request $request): Response
    {
        dump($request->request->get('gangs'));
        dump($request->request);
        dd($request);

        return $this->render('battle/battle2.html.twig');
    }

    /**
     * @Route("/result", name="result")
     */
    public function result(): Response
    {
        return $this->render('battle/result.html.twig');
    }
}
