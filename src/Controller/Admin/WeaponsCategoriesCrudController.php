<?php

namespace App\Controller\Admin;

use App\Entity\WeaponsCategories;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WeaponsCategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WeaponsCategories::class;
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
