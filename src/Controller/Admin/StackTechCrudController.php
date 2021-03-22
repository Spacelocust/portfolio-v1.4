<?php

namespace App\Controller\Admin;

use App\Entity\StackTech;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class StackTechCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StackTech::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('une compétence')
            ->setEntityLabelInPlural('Compétences')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Nom du langage'),
            ImageField::new('picture', 'Image de fond')
                ->setBasePath($this->getParameter('app.path.pictures_tech'))
                ->hideOnForm(),
            ImageField::new('pictureFile','Image de fond')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions(['allow_delete' => false])
                ->onlyOnForms(),
        ];
    }
}
