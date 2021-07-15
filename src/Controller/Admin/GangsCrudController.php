<?php

namespace App\Controller\Admin;

use App\Entity\Gangs;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GangsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gangs::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
