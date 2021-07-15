<?php

namespace App\Controller\Admin;

use App\Entity\Gangers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GangersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gangers::class;
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
