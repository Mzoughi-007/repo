<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ChapitreController extends AbstractController
{
    #[Route('/chapitre', name: 'app_chapitre')]
    public function index(): Response
    {
        return $this->render('chapitre/index.html.twig', [
            'controller_name' => 'ChapitreController',
        ]);
    }
    #[Route('/add', name: 'app_chapitre')]
    public function list():response{
        $authors = [
            array('id' =>1,'nom'=> 'ch1', 'ordre'=> 1 ),
            array('id' =>2 ,'nom'=> 'ch2', 'ordre'=> 2),
            array('id' =>3,'nom'=> 'ch3', 'ordre'=> 3)
        ];
        return $this->render('author/list.html.twig', [
            'authors'=> $authors
        ]);
            
    }
}
