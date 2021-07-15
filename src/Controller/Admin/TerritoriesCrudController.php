<?php

namespace App\Controller\Admin;

use App\Entity\Territories;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TerritoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Territories::class;
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
