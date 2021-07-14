<?php

namespace App\Controller\Admin;

use App\Entity\GangersTypes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GangersTypesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GangersTypes::class;
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
