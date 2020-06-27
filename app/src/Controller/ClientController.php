<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends AbstractController
{
    /**
     * @Route("/newclient", name="newclient")
     */
    public function createClient(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $client = new Client();
        $client->setFirstName($request->get('firstName'));
        $client->setLastName($request->get('lastName'));
        $client->setCountry($request->get('country'));
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
    public function listClient()
    {
        $client = $this->getDoctrine()
        ->getRepository(Client::class)
        ->findAll();
        return $this->render('list.html.twig', array('clients' => $client));
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
