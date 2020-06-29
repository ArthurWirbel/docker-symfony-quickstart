<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Service\PhoneCheck;

class ClientController extends AbstractController
{
    /**
     * @Route("/newclient", name="newclient")
     */
    public function createClient(Request $request, PhoneCheck $phoneCheck): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Check phone number

        $message = $phoneCheck->checkPhoneNumber($request->get('phoneNumber'), $request->get('country'));
        $data = json_decode($message);
        if ($data[0]->output->isValid) {
            // Save client and success
            $client = new Client();
            $client->setFirstName($request->get('firstName'));
            $client->setLastName($request->get('lastName'));
            $client->setCountry($request->get('country'));
            $client->setNationalPhoneNumber($data[0]->output->national);
            $client->setInternationalPhoneNumber($data[0]->output->international);

            $entityManager->persist($client);

            $entityManager->flush();

        return new Response('Saved new client with id '.$client->getId());
        
    } else {
            return new Response('bad number');
        }
    
        
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
     * @Route("/checkPhone", name="checkPhone")
     */
    public function new(PhoneCheck $phoneCheck): Response
    {
        $message = $phoneCheck->checkPhoneNumber("0633589561", "FR");
        $data = json_decode($message);
        var_dump($data[0]->output->isValid);
        return new Response('cool');
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
