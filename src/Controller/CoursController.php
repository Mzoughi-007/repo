<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CoursController extends AbstractController
{
    #[Route('/cours', name: 'app_cours')]
    public function index(): Response
    {
        return $this->render('cours/index.html.twig', [
            'controller_name' => 'CoursController',
        ]);
    }

    #[Route('/add',name:'cours_add' )]
    public function list():response{
        $cours = [
            array('id' =>1,'ref'=> 'titre1', 'description'=> 1 ),
            array('id' =>2 ,'ref'=> 'titre2', 'ordre'=> 2),
            array('id' =>3,'ref'=> 'titre3', 'ordre'=> 3)
        ];
        return $this->render('cours/list.html.twig', [
            'cours'=> $cours
        ]);
            
    }

}
