<?php

namespace App\Controller\Admin;

use App\Entity\Injuries;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InjuriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Injuries::class;
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
