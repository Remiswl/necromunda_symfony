<?php

namespace App\Controller\Admin;

use App\Entity\SkillsCategories;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SkillsCategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SkillsCategories::class;
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
