<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LandingController extends AbstractController
{
    public function index()
    {
        return $this->render('base.html.twig', []);
    }
}