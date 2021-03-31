<?php

namespace App\Controller\Admin;

use App\Entity\TypeSkill;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeSkillCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeSkill::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un type')
            ->setEntityLabelInPlural('Types compétence')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Intitulé du type'),
        ];
    }
}
