<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListController extends AbstractController
{
    public function list()
    {
        return $this->render('list.html.twig', []);
    }
}