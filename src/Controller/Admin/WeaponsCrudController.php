<?php

namespace App\Controller\Admin;

use App\Entity\Weapons;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WeaponsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Weapons::class;
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
