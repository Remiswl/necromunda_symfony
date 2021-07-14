<?php

namespace App\Controller\Admin;

use App\Entity\Weapons;
use App\Entity\Skills;
use App\Entity\Injuries;
use App\Entity\Houses;
use App\Entity\Territories;
use App\Entity\WeaponsCategories;
use App\Entity\SkillsCategories;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     * Define homepage content
     */
    public function index(): Response
    {
        return parent::index();

        // $routeBuilder = $this->get(AdminUrlGenerator::class);
        //return $this->redirect($routeBuilder->setController(WeaponsCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Necromunda');
    }

    /*
     * Define side menu content
     */
    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('Houses'),
            MenuItem::linkToCrud('Houses', 'fa fa-tags', Houses::class),

            MenuItem::section('Weapons'),
            MenuItem::linkToCrud('Weapons', 'fa fa-tags', Weapons::class),
            MenuItem::linkToCrud('Categories', 'fa fa-tags', WeaponsCategories::class),

            MenuItem::section('Skills'),
            MenuItem::linkToCrud('Skills', 'fa fa-tags', Skills::class),
            MenuItem::linkToCrud('Categories', 'fa fa-tags', SkillsCategories::class),

            MenuItem::section('Injuries'),
            MenuItem::linkToCrud('Injuries', 'fa fa-tags', Injuries::class),

            MenuItem::section('Territories'),
            MenuItem::linkToCrud('Territories', 'fa fa-tags', Territories::class),
        ];
    }
}
