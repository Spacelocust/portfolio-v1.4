<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Project;
use App\Form\ContactType;
use App\Repository\ProjectRepository;
use App\Repository\StackTechRepository;
use App\Repository\TimelineRepository;
use App\Repository\TypeSkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private ProjectRepository $repoProject;
    private TimelineRepository $repoTimeline;
    private StackTechRepository $repoSkill;
    private TypeSkillRepository $repoTypeSkill;

    public function __construct(ProjectRepository $repoProject, TimelineRepository $repoTimeline, StackTechRepository $repoSkill, TypeSkillRepository $repoTypeSkill)
    {
        $this->repoProject = $repoProject;
        $this->repoTimeline = $repoTimeline;
        $this->repoSkill = $repoSkill;
        $this->repoTypeSkill = $repoTypeSkill;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $contact = new Contact();

        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid())
        {
            $manager->persist($contact);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'projects' => array_chunk($this->repoProject->findAll(), 4),
            'timelines' => $this->repoTimeline->findBy([], ['date' => 'DESC']),
            'skills' =>  $this->repoSkill->findAll(),
            'typeSkills' => $this->repoTypeSkill->findAll(),
            'form' => $contactForm->createView(),
        ]);
    }

    /**
     * @Route("/project/{id}", name="single_project")
     * @param Project $project
     * @return Response
     */
    public function project(Project $project): Response
    {
        return $this->render('component/single-project.html.twig', [
            'project' => $project,
        ]);
    }
}
