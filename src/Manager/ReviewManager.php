<?php

namespace App\Manager;

use App\Entity\Vico;
use App\Entity\Client;
use App\Entity\Project1;
use Doctrine\ORM\EntityManagerInterface;

class ReviewManager
{
    public function createNewClient(EntityManagerInterface $em)
    {
        $client = new Client();
        $client->setUsername('afifelcharif@gmail.com')
            ->setPassword('password')
            ->setFirstName('Afif')
            ->setLastName('El Charif')
            ->setCreated();
        $em->persist($client);
        $em->flush();
    }

    public function createNewVico(EntityManagerInterface $em)
    {
        $vico = new Vico();
        $vico->setName('John')
        ->setCreated();
        $em->persist($vico);
        $em->flush();
    }

    public function createNewProject(EntityManagerInterface $em, $clientRepo, $vicoRepo)
    {
        $project = new Project1();
        $project->setCreatorId($clientRepo->findOneBy(['id' => 1]))
            ->setVicoId($vicoRepo->findOneBy(['id' => 1]))
            ->setTitle('Build a site with appointment functionality linked to Shopify')
            ->setCreated();
            $em->persist($project);
            $em->flush();
    }
}