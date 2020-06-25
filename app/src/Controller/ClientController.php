<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClientController extends AbstractController
{
    /**
     * @Route("/newclient", name="newclient")
     */
    public function createClient(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $client = new Client();
        $client->setFirstName("Arthur");
        $client->setLastName("Wirbel");
        $client->setCountry("France");
        $client->setNationalPhoneNumber("06 33 58 95 61");
        $client->setInternationalPhoneNumber("+33 6 33 58 95 61");

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($client);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new client with id '.$client->getId());
    }

    /**
     * @Route("/listclient", name="listclient")
     */
    public function listClient(): JsonResponse
    {
        $client = $this->getDoctrine()
        ->getRepository(Client::class)
        ->findAll();
        print_r($client);
        return new JsonResponse($client);
    }

    /**
     * @Route("/check", name="check")
     */
    public function checkConnection(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->getConnection()->connect();
        $connected = $em->getConnection()->isConnected();
    }

}
