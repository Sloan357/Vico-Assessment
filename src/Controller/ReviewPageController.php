<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Project;
use App\Entity\Review;
use App\Entity\Vico;
use App\Form\ReviewType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewPageController extends AbstractController
{
    #[Route('/review/page', name: 'app_review_page')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        // $client = new Client();
        // $client->setUsername('afifelcharif@gmail.com')
        //     ->setPassword('password')
        //     ->setFirstName('Afif')
        //     ->setLastName('El Charif')
        //     ->setCreated();
        // $em->persist($client);
        // $em->flush();

        $clientRepo = $em->getRepository(Client::class);

        // $vico = new Vico();
        // $vico->setName('John')
        // ->setCreated();
        // $em->persist($vico);
        // $em->flush();

        $vicoRepo = $em->getRepository(Vico::class);

        // $project = new Project();
        // $project->setCreatorId($clientRepo->findOneBy(['id' => 1]))
        //     ->setVicoId($vicoRepo->findOneBy(['id' => 1]))
        //     ->setTitle('Build a site with appointment functionality linked to Shopify')
        //     ->setCreated();

        // $em->persist($project);
        // $em->flush();

        $projectRepo = $em->getRepository(Project::class);


        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $review = $form->getData();

            // ... perform some action

            return $this->redirectToRoute('task_success');
        }

        return $this->render('review_page/index.html.twig', [
            'form' => $form,
        ]);
    }
}
