<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProjectCrudController extends AbstractCrudController implements EventSubscriberInterface
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('une réalisation')
            ->setEntityLabelInPlural('Réalisations')
            ;
    }
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title','Nom de la réalisation'),
            TextEditorField::new('text','Description'),
            TextEditorField::new('appraisal','Bilan'),
            TextField::new('language_tech','Technologie(s) utilisée(s)'),
            ImageField::new('picture', 'Image de fond')
                ->setBasePath($this->getParameter('app.path.pictures_project'))
                ->hideOnForm(),
            ImageField::new('pictureFile','Image de fond')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '1024k',
                            'mimeTypes' => [
                                'image/jpeg',
                                'image/png',
                                'image/jpg',
                            ],
                            'mimeTypesMessage' => 'Votre fichier doit-être du format suivant: png, jpg ou jpeg',
                        ])
                    ],
                ])
                ->onlyOnForms(),
            BooleanField::new('isDocument','Documentation')
                ->hideOnForm()
                ->renderAsSwitch()
                ->setCustomOptions(['disabled' => true]),
            ImageField::new('document', 'Document')
                ->setBasePath($this->getParameter('app.path.doc_project'))
                ->hideOnForm()
                ->hideOnIndex(),
            ImageField::new('documentFile','Document')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'constraints' => [
                        new File([
                            'mimeTypes' => [
                                'application/pdf',
                                'application/x-pdf',
                            ],
                            'mimeTypesMessage' => 'Votre fichier doit-être un fichier format PDF',
                        ])
                    ],
                ])
                ->onlyOnForms(),
            TextField::new('link_project','Lien vers la réalisation'),
            DateField::new('date_start','Début de la réalisation'),
            DateField::new('date_end','Fin de la réalisation'),
        ];
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => 'event',
            BeforeEntityUpdatedEvent::class => 'event',
        ];
    }

    /**
     * @param $event
     * @internal
     */
    public function event($event)
    {
        $instance = $event->getEntityInstance();

        if (get_class($instance) === get_class(new Project())) {
            if (empty($instance->getDocument())) {
                $instance->setIsDocument(false);
            }
        }
    }
}
