<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\OptionalReview;
use App\Entity\Project1;
use App\Entity\Review;
use App\Entity\Vico;
use App\Form\OptionalReviewType;
use App\Form\ReviewType;
use App\Manager\ReviewManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewPageController extends AbstractController
{
    private ReviewManager $reviewManager;
    public function __construct(ReviewManager $reviewManager)
    {
        $this->reviewManager = $reviewManager;
    }


    #[Route('/review/page', name: 'app_review_page')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $clientRepo = $em->getRepository(Client::class);

        $vicoRepo = $em->getRepository(Vico::class);

        $projectRepo = $em->getRepository(Project1::class);

        if (!$clientRepo->findAll()) {
            $this->reviewManager->createNewClient($em);
        }

        if (!$vicoRepo->findAll()) {
            $this->reviewManager->createNewVico($em);
        }

        if (!$projectRepo->findAll()) {
            $this->reviewManager->createNewProject($em, $clientRepo, $vicoRepo);
        }
        //the code far is due to the task being a challenge and not part of a full workflow, this would be replaced
        //by retrieving the client, vico and project info from the DB and session leading to the review page
        

        $vicoName = $vicoRepo->findOneBy(['id' => '1'])->getName();
        $projectTitle = $projectRepo->findOneBy(['id' => '1'])->getTitle();

        $reviewRepo = $em->getRepository(Review::class);

        if ($reviewRepo->findOneBy(['project_id' => '1'])) {
            $review = $reviewRepo->findOneBy(['project_id' => '1']);
        } else {
            $review = new Review();
        }

        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $review = $form->getData();
            $review->setCreatorId($clientRepo->findOneBy(['id' => 1]))
                ->setVicoId($vicoRepo->findOneBy(['id' => 1]))
                ->setProjectId($projectRepo->findOneBy(['id' => 1]))
                ->setCreated();
            
                $em->persist($review);
                $em->flush();

            return $this->redirectToRoute('app_review_second_page');
        }

        return $this->render('review_page/index.html.twig', [
            'form' => $form,
            'vicoName' => $vicoName,
            'projectTitle' => $projectTitle
        ]);
    }

    #[Route('/review/second-page', name: 'app_review_second_page')]
    public function secondPage(Request $request, EntityManagerInterface $em): Response
    {
        $reviewRepo = $em->getRepository(Review::class);

        if(!$reviewRepo->findOneBy(['id' => 1])) {
            return $this->redirectToRoute('app_review_second_page');
        }
        
        $vicoRepo = $em->getRepository(Vico::class);

        $projectRepo = $em->getRepository(Project1::class);

        $vicoName = $vicoRepo->findOneBy(['id' => '1'])->getName();
        $projectTitle = $projectRepo->findOneBy(['id' => '1'])->getTitle();

        $review = $reviewRepo->findOneBy(['id' => 1]);
    
        $optionalReviewRepo = $em->getRepository(OptionalReview::class);

        if ($optionalReviewRepo->findOneBy(['review' => $review])) {
            $optionalReview = $optionalReviewRepo->findOneBy(['review' => $review]);
        } else {
            $optionalReview = new OptionalReview;
        }
        
        $form = $this->createForm(OptionalReviewType::class, $optionalReview);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $optionalReview = $form->getData();
            $optionalReview->setReview($review);
            
                $em->persist($optionalReview);
                $em->flush();

                // dump($review);
                // dump($optionalReview);
                // die();
            return $this->redirectToRoute('success_page');
        }

        return $this->render('review_page/second-page.html.twig', [
            'form' => $form,
            'vicoName' => $vicoName,
            'projectTitle' => $projectTitle
        ]);
    }

    #[Route('/success', name: 'success_page')]
    public function successPage(EntityManagerInterface $em): Response
    {
        $reviewRepo = $em->getRepository(Review::class);
        $review = $reviewRepo->findOneBy(['id' => 1]);

        $optionalReviewRepo = $em->getRepository(OptionalReview::class);
        $optionalReview = $optionalReviewRepo->findOneBy(['review' => $review]);

        dump($review);
        dump($optionalReview);
        die();
    }
}
