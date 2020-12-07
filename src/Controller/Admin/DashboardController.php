<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Entity\StackTech;
use App\Entity\Timeline;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(ProjectCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Menu', 'fa fa-home');
        yield MenuItem::section('Information');
        yield MenuItem::linkToCrud('Réalisation', 'fas fa-archive', Project::class);
        yield MenuItem::linkToCrud('Compétence', 'fas fa-laptop-code', StackTech::class);
        yield MenuItem::linkToCrud('Parcours', 'fas fa-stream', Timeline::class);
    }
}
