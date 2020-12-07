<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('title','Nom de la réalisation'),
            yield TextEditorField::new('text','Description'),
            yield TextField::new('language_tech','technologie(s) utilisée(s)'),
            yield ImageField::new('pictureFile')
                ->setFormType(VichImageType::class),
            yield TextField::new('link_doc','Nom de la documentation'),
            yield TextField::new('link_project','Lien vers la réalisation'),
            yield DateField::new('date_start','Début de la réalisation'),
            yield DateField::new('date_end','Fin de la réalisation'),
        ];
    }
}
