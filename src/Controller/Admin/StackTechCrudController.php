<?php

namespace App\Controller\Admin;

use App\Entity\StackTech;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StackTechCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StackTech::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Nom du langage'),
        ];
    }
}
