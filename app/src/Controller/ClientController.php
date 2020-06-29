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

            return $this->redirectToRoute('success', array());
        
    } else {
            return $this->render('landing.html.twig', array('errorNumber' => true));
        }
    }

    /**
     * @Route("/success", name="success")
     */
    public function success()
    {
        return $this->render('success.html.twig', array());
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
}
