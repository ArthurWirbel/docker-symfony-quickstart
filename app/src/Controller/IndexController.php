<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
 
class IndexController extends AbstractController
{
    public function index()
    {
        return $this->render('landing.html.twig', array("errorNumber" => false));
    }
}

