<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\UsersRepository;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(UsersRepository $repository): Response
    {
        $users = $repository->displayUsers();

        return $this->render('users/index.html.twig', [
            'controller_name' => 'GangsController',
            'users' => $users
        ]);
    }
}